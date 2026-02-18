<?php

namespace App\Tests\Security;

use App\Entity\User;
use App\Security\UserChecker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCheckerTest extends TestCase
{
    private UserChecker $userChecker;

    protected function setUp(): void
    {
        $this->userChecker = new UserChecker();
    }

    public function testCheckPreAuthWithEnabledUser(): void
    {
        $user = $this->createMock(User::class);
        $user->expects($this->once())
            ->method('getRoles')
            ->willReturn(['ROLE_GUEST']);

        $this->userChecker->checkPreAuth($user);
    }

    public function testCheckPreAuthWithDisabledUser(): void
    {
        $user = $this->createMock(User::class);
        $user->expects($this->once())
            ->method('getRoles')
            ->willReturn(['ROLE_DISABLED']);

        $this->expectException(CustomUserMessageAccountStatusException::class);
        $this->expectExceptionMessage('Votre compte est désactivé. Veuillez contacter l\'administrateur pour plus d\'informations.');

        $this->userChecker->checkPreAuth($user);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testCheckPreAuthWithNonUserInstance(): void
    {
        $user = $this->createMock(UserInterface::class);

        $this->userChecker->checkPreAuth($user);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testCheckPostAuthWithUser(): void
    {
        $user = $this->createMock(User::class);

        $this->userChecker->checkPostAuth($user);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testCheckPostAuthWithNonUserInstance(): void
    {
        $user = $this->createMock(UserInterface::class);

        $this->userChecker->checkPostAuth($user);
    }
}