<?php declare(strict_types=1);

// namespace App\Tests\Repository;

// use App\Entity\User;
// use App\Repository\UserRepository;
// use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

// class AlbumRepositoryTest extends KernelTestCase
// {
//     private ?UserRepository $repository = null;

//     protected function setUp(): void
//     {
//         self::bootKernel();
//         $this->repository = static::getContainer()->get(UserRepository::class);
//     }

//     public function testFindByEmail(): void
//     {
//         // Arrange : créer un user en base (via fixtures ou directement)
//         $user = $this->repository->findOneBy(['email' => 'test@example.com']);

//         // Assert
//         $this->assertInstanceOf(User::class, $user);
//         $this->assertSame('test@example.com', $user->getEmail());
//     }

//     public function testSaveAndRemove(): void
//     {
//         $entityManager = static::getContainer()->get('doctrine')->getManager();

//         // Créer
//         $user = new User();
//         $user->setEmail('new@test.com');
//         $user->setPassword('hashed');
//         $user->setAccess(true);

//         $this->repository->save($user, true);

//         // Vérifier qu'il existe
//         $found = $this->repository->find($user->getId());
//         $this->assertNotNull($found);

//         // Supprimer
//         $this->repository->remove($user, true);
//         $this->assertNull($this->repository->find($user->getId()));
//     }
// }