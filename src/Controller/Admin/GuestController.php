<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use App\Entity\User;
use App\Form\GuestType;
use App\Form\MediaType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class GuestController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ){}

    #[Route(path: '/admin/guests', name: 'admin_guests_index')]
    public function index(
        Request $request,
        UserRepository $userRepository,
    )
    {
        $page = $request->query->getInt('page', 1);
        
        // $allUsers = $this->entityManager->getRepository(User::class)->findAll();
        // $filteredUsers = array_filter($allUsers, function($user) {
        //     $roles = $user->getRoles();
        //     return \in_array('ROLE_GUEST', $roles, true) || \in_array('ROLE_DISABLED', $roles, true);
        // });
        // usort($filteredUsers, fn($a, $b) => $a->getId() <=> $b->getId());
        // $total = \count($filteredUsers);
        // $users = \array_slice($filteredUsers, 25 * ($page - 1), 25);

        $users = $userRepository->findNonAdminUsers();

        $total = \count($users);
        $users = \array_slice($users, 25 * ($page - 1), 25);

        return $this->render('admin/guests/index.html.twig', [
            'users' => $users,
            'total' => $total,
            'page' => $page
        ]);
    }

    #[Route(path: '/admin/guests/add', name: 'admin_guests_add')]
    public function add(Request $request)
    {
        $guest = new User();
        $form = $this->createForm(GuestType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($guest);
            $this->entityManager->flush();
            return $this->redirectToRoute('admin_guests_index');
        }

        return $this->render('admin/guests/add.html.twig', ['form' => $form->createView()]);
    }

    #[Route(path: '/admin/guests/delete/{id}', name: 'admin_guests_delete')]
    public function delete(int $id)
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        return $this->redirectToRoute('admin_guests_index');
    }

    #[Route(path: '/admin/guests/toggle-access/{id}', name: 'admin_guests_toggle_access')]
    public function toggleAccess(int $id)
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $currentRoles = $user->getRoles();
        if (\in_array("ROLE_GUEST", $currentRoles, true)) {
            $user->setRoles(["ROLE_DISABLED"]);
        } else {
            $user->setRoles(["ROLE_GUEST"]);
        }
        $this->entityManager->flush();
        return $this->redirectToRoute('admin_guests_index');
    }
}