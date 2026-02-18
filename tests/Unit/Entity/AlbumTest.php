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

    public function testAddMediaInAlbum(): void
    {
        $media = new Media();
        $album = new Album();
        $album->addMedia($media);
        $this->assertContains($media, $album->getMedias());
    }

    public function testRemoveMediaInAlbum(): void
    {
        $media = new Media();
        $album = new Album();
        $album->addMedia($media);
        $album->removeMedia($media);
        $this->assertCount(0, $album->getMedias());
    }

}