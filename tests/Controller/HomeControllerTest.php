<?php declare(strict_types=1);

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    
    private $client;
    private ?EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = static::getContainer()->get(EntityManagerInterface::class);
        
        // Nettoyer la BDD avant chaque test
        $this->em->createQuery('DELETE FROM App\Entity\User')->execute();
    }

    // TESTS
    public function testHomePageIsAccessible(): void
    {
        $this->client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }
    public function testGuestsPageIsAccessible(): void
    {
        $this->client->request('GET', '/guests');
        $this->assertResponseIsSuccessful();
    }
    public function testAboutPageIsAccessible(): void
    {
        $this->client->request('GET', '/about');
        $this->assertResponseIsSuccessful();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null;
    }
} 