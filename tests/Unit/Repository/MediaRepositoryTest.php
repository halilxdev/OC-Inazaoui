<?php declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\Media;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MediaRepositoryTest extends KernelTestCase
{
    private ?MediaRepository $repository = null;
    private ?EntityManager $entityManager = null;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = static::getContainer()->get(MediaRepository::class);
        $this->entityManager = static::getContainer()->get('doctrine')->getManager();
    }

    public function testConstruct(): void
    {
        $this->assertInstanceOf(MediaRepository::class, $this->repository);
    }

    public function testFindByTitle(): void
    {
        $media = new Media();
        $media->setTitle("Test");
        $media->setPath("test/path.jpg");
        $this->entityManager->persist($media);
        $this->entityManager->flush();

        $foundMedia = $this->repository->find($media->getId());
        $this->assertInstanceOf(Media::class, $foundMedia);
        $this->assertSame('Test', $foundMedia->getTitle());
        $this->assertSame('test/path.jpg', $foundMedia->getPath());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->repository = null;
        $this->entityManager = null;
    }
}