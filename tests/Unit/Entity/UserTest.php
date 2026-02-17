<?php declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Media;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testUserGettersAndSetters(): void
    {
        $user = new User();
        
        $user->setEmail('test@test.com');
        $user->setName('Halil');
        $user->setDescription('Dev PHP');
        $user->setPassword('hashed_password');
        $user->setRoles(["ROLE_GUEST"]);
        
        $this->assertEquals('test@test.com', $user->getEmail());
        $this->assertEquals('Halil', $user->getName());
        $this->assertEquals('Dev PHP', $user->getDescription());
        $this->assertEquals('hashed_password', $user->getPassword());
        $this->assertEquals(["ROLE_GUEST"], $user->getRoles());
        $this->assertEquals('test@test.com', $user->getUserIdentifier());
        $this->assertCount(0, $user->getMedias());
    }

    public function testUserHasMedias(): void
    {
        $user = new User();
        $media1 = new Media();
        $media2 = new Media();
        $collection = new ArrayCollection([$media1, $media2]);
        $user->setMedias($collection);
        $this->assertCount(2, $user->getMedias());
    }

    public function testNewUserHasDefaultValues(): void
    {
        $user = new User();
        $this->assertNull($user->getId());
        $this->assertEquals(["ROLE_GUEST"], $user->getRoles());
    }
    
    public function testUserCanBePromotedToAdmin(): void
    {
        $user = new User();
        
        $user->setRoles(["ROLE_ADMIN"]);
        
        $this->assertEquals(["ROLE_ADMIN"], $user->getRoles());
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
    }
    
    public function testUserIdentifierReturnsEmail(): void
    {
        $user = new User();
        $user->setEmail('halil@denizworks.fr');
        $this->assertEquals('halil@denizworks.fr', $user->getUserIdentifier());
    }
    
    public function testEraseCredentialsClearsPlainPassword(): void
    {
        $user = new User();
        $user->setPassword('secret123');
        $user->eraseCredentials();
        $this->assertNull($user->getPassword());
    }
}