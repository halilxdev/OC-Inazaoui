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
        $user->setRoles(["ROLE_GUEST"]);
        
        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('test@example.com', $user->getEmail());
    }

    public function testSaveAndRemove(): void
    {
        $user = new User();
        $user->setEmail('new@test.com');
        $user->setName('Test');
        $user->setPassword('hashed');
        $user->setRoles(["ROLE_GUEST"]);

        $this->entityManager->persist($user);

        $found = $this->repository->find($user->getId());
        $this->assertNotNull($found);

        $this->entityManager->remove($user);
        $this->assertNull($this->repository->find($user));
    }

    public function testUpgradePassword(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setName('Test');
        $user->setPassword('oldPassword');
        $user->setRoles(["ROLE_GUEST"]);
        
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
            public function getPassword(): ?string { return 'fake'; }
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