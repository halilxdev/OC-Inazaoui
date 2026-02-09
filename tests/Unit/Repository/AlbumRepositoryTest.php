<?php declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\AlbumRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Proxies\__CG__\App\Entity\Album;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AlbumRepositoryTest extends KernelTestCase
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
        $albumRepository = new AlbumRepository($managerRegistry);
        $this->assertNotNull($albumRepository);
    }

    public function testFindByTitle(): void
    {
        $album = new Album();
        $album->setName("Test");
        $this->assertInstanceOf(Album::class, $album);
        $this->assertSame('Test', $album->getName());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->repository = null;
        $this->entityManager = null;
    }
}