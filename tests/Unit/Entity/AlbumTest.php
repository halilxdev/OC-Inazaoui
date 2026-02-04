<?php declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Album;
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
}