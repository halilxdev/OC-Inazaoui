<?php declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Album;
use App\Entity\Media;
use PHPUnit\Framework\TestCase;

class AlbumTest extends TestCase
{

    public function testAlbumGettersAndSetters(): void
    {
        $album = new Album();
        
        $album->setName("Album de test");
        
        $this->assertNull($album->getId());
        $this->assertEquals('Album de test', $album->getName());
    }

    public function testAlbumHasMedia(): void
    {
        $media1 = new Media();
        $media1->setTitle("Premier media");
        $media2 = new Media();
        $media2->setTitle("Second media");

        $album = new Album();
        $media1->setAlbum($album);
        $media2->setAlbum($album);

        $this->assertContains($media1, $media1->getAlbum());
    }

}