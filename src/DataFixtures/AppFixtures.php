<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Media;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
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
        $user->setEmail('inazaoui@gmail.com');
        $user->setName("Ina Zaoui");
        $user->setDescription('Propriétaire du site.');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $user->setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);
        
        // Bunch of Users
        for($i = 0; $i <= 100; $i++)
        {
            $user = new User();
            $user->setName("Invité {$i}");
            $user->setEmail("invite+{$i}@example.com");
            $user->setDescription("Le maître de l''urbanité capturée, explore les méandres des cités avec un regard vif et impétueux, figeant l''énergie des rues dans des instants éblouissants. À travers une technique avant-gardiste, il métamorphose le béton et l''acier en toiles abstraites");
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $user->setRoles(["ROLE_USER"]);

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
        for($i = 1; $i <= 5049; $i++)
        {
            $s = strval($i);
            $media = new Media();
            $media->setPath("uploads/" . str_pad($s, 4, '0', STR_PAD_LEFT) . ".jpg");
            $media->setTitle("Media {$i}");
            $media->setAlbum($albums[array_rand($albums)]);
            $media->setUser($users[array_rand($users)]);

            $manager->persist($media);
        }

        $manager->flush();
    }
}
