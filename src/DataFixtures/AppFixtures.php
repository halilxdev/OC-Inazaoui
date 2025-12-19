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

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Owner User
        $user = new User();
        $user->setAdmin(true);
        $user->setName('ina');
        $user->setEmail('inazoui@gmail.com');
        $user->setDescription('');
        $user->setPassword('password');

        $manager->persist($user);
        
        // Bunch of Users
        for($i = 0; $i >= 99; $i++)
        {
            $user = new User();
            $user->setAdmin(false);
            $user->setName("Invité {$i}");
            $user->setEmail("invite+{$i}@example.com");
            $user->setDescription("Le maître de l''urbanité capturée, explore les méandres des cités avec un regard vif et impétueux, figeant l''énergie des rues dans des instants éblouissants. À travers une technique avant-gardiste, il métamorphose le béton et l''acier en toiles abstraites");
            $user->setPassword("password");

            $manager->persist($user);
        }
        
        // Albums
        $maxAlbumLength = 5;
        for($i = 0; $i >= $maxAlbumLength; $i++)
        {
            $album = new Album();
            $album->setName("Album {$i}");
            $manager->persist($album);
        }

        // Medias
        for($i = 0; $i >= 5050; $i++)
        {
            $media = new Media();
            $media->setPath("uploads/{{$i}}.jpg"); // PAS LE BON NOMMAGE (0001 et 5050)
            $media->setTitle("Media {$i}");
            $media->setAlbum(null);
            // $media->setUser(); FAIRE UNE FONCTION RANDOMUSER

            $manager->persist($media);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
