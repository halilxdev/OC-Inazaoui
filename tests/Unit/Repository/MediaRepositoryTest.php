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

    // public function testSaveAndRemove(): void
    // {
    //     $user = new User();
    //     $user->setAccess(true);
    //     $user->setEmail("test@gmail.co");
    //     $user->setPassword('password');
    //     $user->setName("Test");
        
    //     $album = new Album();
    //     $album->setName("Album test");

    //     $uploadedFile = $this->createMock(UploadedFile::class);
    //     $uploadedFile->method('getClientOriginalName')->willReturn('photo.jpg');
    //     $uploadedFile->method('getMimeType')->willReturn('image/jpeg');
    //     $uploadedFile->method('getSize')->willReturn(1024);
    //     $uploadedFile->method('move')->willReturn(new \Symfony\Component\HttpFoundation\File\File('public/images/home.jpeg'));
    //     $path = "image.jpg";
    //     $media = new Media();
    //     $media->setTitle('Media test');
    //     $media->setAlbum($album);
    //     $media->setPath($path);
    //     $media->setFile($uploadedFile);
    //     $media->setUser($user);

    //     $this->entityManager->persist($user);
    //     $this->entityManager->persist($album);
    //     $this->entityManager->persist($media);
    //     $this->entityManager->flush();

    //     $found = $this->repository->find($media->getId());
    //     $this->assertNotNull($found);

    //     $this->entityManager->remove($media);
    //     $this->assertNull($this->repository->find($media));
    // }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->repository = null;
        $this->entityManager = null;
    }
}