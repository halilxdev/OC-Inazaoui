<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Media;
use App\Entity\User;
use App\Repository\AlbumRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // Admin User
        $user = new User();
        $user->setAdmin(true);
        $user->setName('ina');
        $user->setEmail('inazaoui@gmail.com');
        $user->setDescription('');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));

        $manager->persist($user);
        
        // Bunch of Users
        for($i = 0; $i <= 99; $i++)
        {
            $user = new User();
            $user->setAdmin(false);
            $user->setName("Invité {$i}");
            $user->setEmail("invite+{$i}@example.com");
            $user->setDescription("Le maître de l''urbanité capturée, explore les méandres des cités avec un regard vif et impétueux, figeant l''énergie des rues dans des instants éblouissants. À travers une technique avant-gardiste, il métamorphose le béton et l''acier en toiles abstraites");
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));

            $manager->persist($user);
        }
        $manager->flush();

        // Récupérer tous les utilisateurs
        $users = $manager->getRepository(User::class)->findAll();

        // // Albums
        $maxAlbumLength = 5;
        for($i = 0; $i <= $maxAlbumLength; $i++)
        {
            $album = new Album();
            $album->setName("Album {$i}");
            $manager->persist($album);
        }
        $manager->flush();

        // Récupérer tous les albums
        $albums = $manager->getRepository(Album::class)->findAll();

        // Medias
        for($i = 1; $i <= 5050; $i++)
        {
            $media = new Media();
            $media->setPath("uploads/" . str_pad($i, 4, '0', STR_PAD_LEFT) . ".jpg");
            $media->setTitle("Media {$i}");
            $media->setAlbum($albums[array_rand($albums)]);
            $media->setUser($users[array_rand($users)]);

            $manager->persist($media);
        }

        $manager->flush();
    }
}
