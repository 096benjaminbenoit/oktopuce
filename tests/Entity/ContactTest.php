<?php

namespace App\Tests\Entity;

use App\Entity\Contact;
use App\Entity\Site;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContactTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateContact()
    {
        $contact = new Contact();
        $contact->setLastName('Doe');
        $contact->setFirstName('John');
        $contact->setPhone('1234567890');
        $contact->setEmail('contact@example.com');
        $contact->setPosition('Manager');

        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        $this->assertNotNull($contact->getId());
    }

    public function testAddRemoveSite()
    {
        $contact = new Contact();
        $contact->setLastName('Doe');
        $contact->setFirstName('John');
        $contact->setPhone('555-1234');
        $contact->setEmail('contact@example.com');
        $contact->setPosition('Manager');

        $site = new Site();
        $site->setName('Site Name');
        $site->setContact($contact);

        $contact->addSite($site);

        $this->assertCount(1, $contact->getSite());

        $contact->removeSite($site);

        $this->assertCount(0, $contact->getSite());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}