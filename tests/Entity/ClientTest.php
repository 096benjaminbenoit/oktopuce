<?php
namespace App\Tests\Entity;

use App\Entity\Client;
use App\Entity\Person;
use App\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ClientTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel=self::bootKernel();

        $this->entityManager =$kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateClient()
    {
        $client = new Client();
        $client->setAddress('123 Main Street');
        $client->setPostCode('12345');
        $client->setCity('City');
        $client->setPhone('1234567890');
        $client->setEmail('client@example.com');

        $person = new Person();
        $person->setLastName('John Doe');
        $person->setFirstName('fatima');
        $person->setPhone('1234567890');
        $client->setPerson($person);

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        $this->assertNotNull($client->getId());
    }

    public function testAddRemoveSite()
    {
        $client = new Client();
        $client->setAddress('123 Main Street');
        $client->setPostCode('12345');
        $client->setCity('City');
        $client->setPhone('1234567890');
        $client->setEmail('client@example.com');

        $person = new Person();
        $person->setLastName('John Doe');
        $person->setFirstName('fatima');
        $person->setPhone('1234567890');
        $client->setPerson($person);

        $site = new Site();
        $site->setName('Site Name');
        $site->setClient($client);

        $client->addSite($site);

        $this->assertCount(1, $client->getSites());

        $client->removeSite($site);

        $this->assertCount(0, $client->getSites());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
