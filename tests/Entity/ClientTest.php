<?php
use App\Entity\Client;
use App\Entity\Site;
use App\Entity\Person;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testCreateClient()
    {
        $client = new Client();

        $this->assertInstanceOf(Client::class, $client);
        $this->assertNull($client->getId());
        $this->assertEmpty($client->getAddress());
        $this->assertEmpty($client->getPostCode());
        $this->assertEmpty($client->getCity());
        $this->assertEmpty($client->getPhone());
        $this->assertEmpty($client->getEmail());
        $this->assertNull($client->getPerson());
        $this->assertCount(0, $client->getSites());
    }

    public function testAddSite()
    {
        $client = new Client();
        $site = new Site();

        $client->addSite($site);

        $this->assertTrue($client->getSites()->contains($site));
        $this->assertSame($client, $site->getClient());
    }

    public function testRemoveSite()
    {
        $client = new Client();
        $site = new Site();
        $client->addSite($site);

        $client->removeSite($site);

        $this->assertFalse($client->getSites()->contains($site));
        $this->assertNull($site->getClient());
    }

    public function testSetAndGetPerson()
    {
        $client = new Client();
        $person = new Person();

        $client->setPerson($person);

        $this->assertSame($person, $client->getPerson());
    }
}
