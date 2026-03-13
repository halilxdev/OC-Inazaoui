<?php declare(strict_types=1);

namespace App\Tests;

use App\Entity\Album;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{

    private KernelBrowser $client;
    private ?EntityManagerInterface $em;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->em = static::getContainer()->get(EntityManagerInterface::class);
        $this->em->createQuery('DELETE FROM App\Entity\User')->execute();
    }

    // TESTS

    // Page d'accueil
    public function testHomePageIsAccessible(): void
    {
        $this->client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Photographe');
    }

    // Page à propos
    public function testAboutPageIsAccessible(): void
    {
        $this->client->request('GET', '/about');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Qui suis-je ?');
    }

    // Page invités
    public function testGuestsPageIsAccessible(): void
    {
        $this->client->request('GET', '/guests');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Invités');
    }

    public function testGuestPageShowsSpecificUser(): void
    {
        $guest = new User();
        $guest->setEmail('test@test.com');
        $guest->setDescription("Description test");
        $guest->setPassword('password');
        $guest->setName('Single Guest');
        $guest->setRoles(["ROLE_USER"]);

        $this->em->persist($guest);
        $this->em->flush();

        $id = $guest->getId();

        $this->client->request('GET', '/guest/' . $id);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Single Guest');
    }

    public function testGuestPageReturns404ForNonExistentUser(): void
    {
        $this->client->catchExceptions(true);
        // $this->expectException(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class);
        $this->client->request('GET', '/guest/999999');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testGuestsPageLinksToSingleGuest(): void
    {
        $guest = new User();
        $guest->setEmail('link@test.com');
        $guest->setPassword('password');
        $guest->setName('Link Test');
        $guest->setRoles(["ROLE_USER"]);

        $this->em->persist($guest);
        $this->em->flush();

        $crawler = $this->client->request('GET', '/guests');
        $link = $crawler->selectLink('découvrir')->link();
        $this->client->click($link);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Link Test');
    }

    // Page portfolios
    public function testPortfolioPageIsAccessible(): void
    {
        $this->client->request('GET', '/portfolio');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Portfolio');
    }

    public function testPortfolioPageShowsSpecificAlbum(): void
    {
        $album = new Album();
        $album->setName("Album de test");

        $this->em->persist($album);
        $this->em->flush();

        $id = $album->getId();

        $this->client->request('GET', '/portfolio/' . $id);

        $this->assertResponseIsSuccessful();
        $this->assertAnySelectorTextContains('a', 'Album de test');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->em->close();
        $this->em = null;
    }
} 