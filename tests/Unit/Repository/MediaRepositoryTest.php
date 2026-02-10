<?php declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\Album;
use App\Entity\Media;
use App\Entity\User;
use App\Repository\MediaRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MediaRepositoryTest extends KernelTestCase
{
    private ?UserRepository $repository = null;
    private ?EntityManager $entityManager = null;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = static::getContainer()->get(UserRepository::class);
        $this->entityManager = static::getContainer()->get('doctrine')->getManager();
    }

    public function testConstruct(): void
    {
        $managerRegistry = $this->createMock(ManagerRegistry::class);
        $mediaRepository = new MediaRepository($managerRegistry);
        $this->assertNotNull($mediaRepository);
    }

    public function testFindByTitle(): void
    {
        $media = new Media();
        $media->setTitle("Test");
        $this->assertInstanceOf(Media::class, $media);
        $this->assertSame('Test', $media->getTitle());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->repository = null;
        $this->entityManager = null;
    }
}