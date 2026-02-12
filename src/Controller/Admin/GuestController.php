<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use App\Entity\User;
use App\Form\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
class GuestController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ){}

    #[Route(path: '/admin/guests', name: 'admin_guests_index')]
    public function index(Request $request)
    {
        $page = $request->query->getInt('page', 1);

        $users = $this->entityManager->getRepository(User::class)->findBy(
            ["admin" => false],
            ['id' => 'ASC'],
            25,
            25 * ($page - 1)
        );
        // array_shift($users);
        $total = $this->entityManager->getRepository(User::class)->count([]);

        return $this->render('admin/guests/index.html.twig', [
            'users' => $users,
            'total' => $total,
            'page' => $page
        ]);
    }

    #[Route(path: '/admin/guests/add', name: 'admin_guests_add')]
    public function add(Request $request)
    {
        $media = new Media();
        $form = $this->createForm(MediaType::class, $media, ['is_admin' => $this->isGranted('ROLE_ADMIN')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->isGranted('ROLE_ADMIN')) {
                $media->setUser($this->getUser());
            }
            $media->setPath('uploads/' . md5(uniqid()) . '.' . $media->getFile()->guessExtension());
            $media->getFile()->move('uploads/', $media->getPath());
            $this->entityManager->persist($media);
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_media_index');
        }

        return $this->render('admin/guests/add.html.twig', ['form' => $form->createView()]);
    }

    #[Route(path: '/admin/guests/delete/{id}', name: 'admin_guests_delete')]
    public function delete(int $id)
    {
        $media = $this->entityManager->getRepository(Media::class)->find($id);
        $this->entityManager->remove($media);
        $this->entityManager->flush();
        unlink($media->getPath());

        return $this->redirectToRoute('admin_media_index');
    }
}