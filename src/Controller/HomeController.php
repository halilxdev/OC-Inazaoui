<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Media;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager
    ){}

    #[Route('/', name: 'home')]
    public function home()
    {
        return $this->render('front/home.html.twig');
    }

    #[Route('/guests', name: 'guests')]
    public function guests()
    {
        $allUsers = $this->entityManager->getRepository(User::class)->findAll();
        $guests = array_filter($allUsers, function($user) {
            $roles = $user->getRoles();
            return \in_array('ROLE_GUEST', $roles, true) || \in_array('ROLE_DISABLED', $roles, true);
        });
        usort($guests, fn($a, $b) => $a->getId() <=> $b->getId());

        return $this->render('front/guests.html.twig', [
            'guests' => $guests
        ]);
    }

    #[Route('/guest/{id}', name: 'guest')]
    public function guest(int $id)
    {
        $guest = $this->entityManager->getRepository(User::class)->find($id);
        if (!$guest) {
            throw $this->createNotFoundException();
        }
        return $this->render('front/guest.html.twig', [
            'guest' => $guest
        ]);
    }

    #[Route(path: '/portfolio/{id}', name: 'portfolio')]
    public function portfolio(?int $id = null)
    {
        $albums = $this->entityManager->getRepository(Album::class)->findAll();
        $album = $id ? $this->entityManager->getRepository(Album::class)->find($id) : null;
        $user = $this->entityManager->getRepository(User::class)->findOneBy(["email"=>"inazaoui@gmail.com"]);
        $medias = $album 
            ? $this->entityManager->getRepository(Media::class)->findMediasByUserWithAccess($album)
            : $this->entityManager->getRepository(Media::class)->findAllMediasByUserWithAccess();

        return $this->render('front/portfolio.html.twig', [
            'albums' => $albums,
            'album' => $album,
            'medias' => $medias
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about()
    {
        return $this->render('front/about.html.twig');
    }
}