<?php declare(strict_types=1);

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserRepositoryTest extends KernelTestCase
{
    private ?UserRepository $repository = null;
    private ?EntityManager $entityManager = null;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = static::getContainer()->get(UserRepository::class);
        $this->entityManager = static::getContainer()->get('doctrine')->getManager();
    }

    public function testFindByEmail(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setPassword('password');
        $user->setRoles(["ROLE_USER"]);
        
        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('test@example.com', $user->getEmail());
    }

    public function testSaveAndRemove(): void
    {
        $user = new User();
        $user->setEmail('new@test.com');
        $user->setName('Test');
        $user->setPassword('hashed');
        $user->setRoles(["ROLE_USER"]);

        $this->entityManager->persist($user);

        $found = $this->repository->find($user->getId());
        $this->assertNotNull($found);

        $this->entityManager->remove($user);
        $this->assertNull($this->repository->find($user));
    }

    public function testFindNonAdminUsers(): void
    {
        $adminUser = new User();
        $adminUser->setEmail('admin@test.com');
        $adminUser->setName('Admin User');
        $adminUser->setPassword('hashed');
        $adminUser->setRoles(['ROLE_ADMIN']);

        $this->entityManager->persist($adminUser);

        $guestUser = new User();
        $guestUser->setEmail('guest@test.com');
        $guestUser->setName('Guest User');
        $guestUser->setPassword('hashed');
        $guestUser->setRoles(['ROLE_USER']);

        $this->entityManager->persist($guestUser);

        
        $this->entityManager->flush();

        $nonAdminUsers = $this->repository->findNonAdminUsers();

        $this->assertEquals('guest@test.com', $nonAdminUsers[0]->getEmail());

        $this->entityManager->remove($adminUser);
        $this->entityManager->remove($guestUser);

        $this->entityManager->flush();
    }

    public function testUpgradePassword(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setName('Test');
        $user->setPassword('oldPassword');
        $user->setRoles(["ROLE_USER"]);
        
        $oldPassword = $user->getPassword();
        $newHashedPassword = 'newPassword';

        $this->repository->upgradePassword($user, $newHashedPassword);

        $this->assertSame($newHashedPassword, $user->getPassword());
        $this->assertNotSame($oldPassword, $user->getPassword());

        $this->entityManager->clear();
        $refreshedUser = $this->repository->find($user->getId());
        $this->assertSame($newHashedPassword, $refreshedUser->getPassword());
    }

    public function testUpgradePasswordWithInvalidUserThrowsException(): void
    {
        $fakeUser = new class implements PasswordAuthenticatedUserInterface {
            public function getPassword(): string { return 'fake'; }
        };
        $this->expectException(UnsupportedUserException::class);
        $this->repository->upgradePassword($fakeUser, 'new_password');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->repository = null;
        $this->entityManager = null;
    }
}