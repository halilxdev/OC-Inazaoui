<?php declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Album;
use App\Entity\Media;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaTest extends TestCase
{

    public function testMediaGettersAndSetters(): void
    {
        $user = new User();
        $media = new Media();
        $album = new Album();
        
        $media->setTitle("Titre de test");
        $media->setUser($user);
        $media->setAlbum($album);
        $media->setPath('images/0001.jpg');
        $media->setFile(null);
        
        $this->assertNull($media->getId());
        $this->assertEquals('Titre de test', $media->getTitle());
        $this->assertEquals($user, $media->getUser());
        $this->assertEquals($album, $media->getAlbum());
        $this->assertEquals('images/0001.jpg', $media->getPath());
        $this->assertNull($media->getFile());
    }

    public function testMediaChangingAlbum(): void
    {
        $media = new Media();
        $album1 = new Album();
        $album1->setName("Premier album");
        $album2 = new Album();
        $album2->setName("Second album");

        $media->setAlbum($album1);
        $media->setAlbum($album2);
        $this->assertEquals('Second album', $media->getAlbum()->getName());
    }

}