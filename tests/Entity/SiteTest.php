<?php
namespace App\Tests\Entity;

use App\Entity\Site;
use App\Entity\Client;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SiteTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateSite()
    {
        $site = new Site();
        $site->setAddress('123 Main St');
        $site->setCity('Cityville');
        $site->setPostCode('12345');
        $site->setName('Site A');

        // Create and associate a Client
        $client = new Client();
        $client->setAddress('123 Main Street');
        $client->setPostCode('12345');
        $client->setCity('City');
        $client->setPhone('1234567890');
        $client->setEmail('client@example.com');

        // Create and associate a Contact
        $contact = new Contact();
        $contact->setLastName('Doe');
        $contact->setFirstName('John');
        $contact->setPhone('555-1234');
        $contact->setEmail('contact@example.com');
        $contact->setPosition('Manager');
        $site->setContact($contact);

        $this->entityManager->persist($site);
        $this->entityManager->persist($client);
        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        $this->assertNotNull($site->getId());
        $this->assertNotNull($client->getId());
        $this->assertNotNull($contact->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Clean up resources, if necessary
    }
}
