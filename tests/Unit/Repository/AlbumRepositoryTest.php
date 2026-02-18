<?php declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AlbumRepositoryTest extends KernelTestCase
{

    private ?AlbumRepository $repository = null;
    private ?EntityManager $entityManager = null;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = static::getContainer()->get(AlbumRepository::class);
        $this->entityManager = static::getContainer()->get('doctrine')->getManager();
    }
    

    public function testConstruct(): void
    {
        $this->assertInstanceOf(AlbumRepository::class, $this->repository);
    }

    public function testFindByTitle(): void
    {
        $album = new Album();
        $album->setName("Test");
        $this->entityManager->persist($album);
        $this->entityManager->flush();

        $foundAlbum = $this->repository->find($album->getId());
        $this->assertInstanceOf(Album::class, $foundAlbum);
        $this->assertSame('Test', $foundAlbum->getName());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->repository = null;
        $this->entityManager = null;
    }
}