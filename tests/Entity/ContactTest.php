<?php
use App\Entity\Contact;
use App\Entity\Site;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function testCreateContact()
    {
        $contact = new Contact();

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertNull($contact->getId());
        $this->assertEmpty($contact->getLastName());
        $this->assertEmpty($contact->getFirstName());
        $this->assertEmpty($contact->getPhone());
        $this->assertEmpty($contact->getEmail());
        $this->assertEmpty($contact->getPosition());
        $this->assertCount(0, $contact->getSite());
    }

    public function testAddSite()
    {
        $contact = new Contact();
        $site = new Site();

        $contact->addSite($site);

        $this->assertTrue($contact->getSite()->contains($site));
    }

    public function testRemoveSite()
    {
        $contact = new Contact();
        $site = new Site();
        $contact->addSite($site);

        $contact->removeSite($site);

        $this->assertFalse($contact->getSite()->contains($site));
    }

    public function testSetAndGetProperties()
    {
        $contact = new Contact();

        $contact->setLastName('Doe');
        $contact->setFirstName('John');
        $contact->setPhone('123456789');
        $contact->setEmail('john@example.com');
        $contact->setPosition('Manager');

        $this->assertEquals('Doe', $contact->getLastName());
        $this->assertEquals('John', $contact->getFirstName());
        $this->assertEquals('123456789', $contact->getPhone());
        $this->assertEquals('john@example.com', $contact->getEmail());
        $this->assertEquals('Manager', $contact->getPosition());
    }
}
