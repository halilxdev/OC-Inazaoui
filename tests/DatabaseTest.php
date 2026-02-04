<?php declare(strict_types=1);

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DatabaseTest extends KernelTestCase
{
    private ?EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testDatabaseConnection(): void
    {
        $connection = $this->entityManager->getConnection();
        $connection->executeQuery('SELECT 1');
        $this->assertTrue($connection->isConnected());
    }

    public function testDatabaseQuery(): void
    {
        $connection = $this->entityManager->getConnection();
        $result = $connection->fetchAssociative('SELECT 1 as test');
        $this->assertEquals(1, $result['test']);
    }

    public function testDatabaseTableExists(): void
    {
        $connection = $this->entityManager->getConnection();
        $schemaManager = $connection->createSchemaManager();
        $tables = $schemaManager->listTableNames();
        $this->assertNotEmpty($tables);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}