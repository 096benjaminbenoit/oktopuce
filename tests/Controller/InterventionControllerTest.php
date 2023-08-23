<?php

namespace App\Test\Controller;

use App\Entity\Intervention;
use App\Repository\InterventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InterventionControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private InterventionRepository $repository;
    private string $path = '/intervation/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Intervention::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Intervention index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'intervention[technicien]' => 'Testing',
            'intervention[entreprise]' => 'Testing',
            'intervention[type]' => 'Testing',
            'intervention[interventionDate]' => 'Testing',
            'intervention[equipment]' => 'Testing',
            'intervention[person]' => 'Testing',
        ]);

        self::assertResponseRedirects('/intervation/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Intervention();
        $fixture->setTechnicien('My Title');
        $fixture->setEntreprise('My Title');
        $fixture->setType('My Title');
        $fixture->setInterventionDate('My Title');
        $fixture->setequipment('My Title');
        $fixture->setPerson('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Intervention');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Intervention();
        $fixture->setTechnicien('My Title');
        $fixture->setEntreprise('My Title');
        $fixture->setType('My Title');
        $fixture->setInterventionDate('My Title');
        $fixture->setequipment('My Title');
        $fixture->setPerson('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'intervention[technicien]' => 'Something New',
            'intervention[entreprise]' => 'Something New',
            'intervention[type]' => 'Something New',
            'intervention[interventionDate]' => 'Something New',
            'intervention[equipment]' => 'Something New',
            'intervention[person]' => 'Something New',
        ]);

        self::assertResponseRedirects('/intervation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTechnicien());
        self::assertSame('Something New', $fixture[0]->getEntreprise());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getInterventionDate());
        self::assertSame('Something New', $fixture[0]->getequipment());
        self::assertSame('Something New', $fixture[0]->getPerson());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Intervention();
        $fixture->setTechnicien('My Title');
        $fixture->setEntreprise('My Title');
        $fixture->setType('My Title');
        $fixture->setInterventionDate('My Title');
        $fixture->setequipment('My Title');
        $fixture->setPerson('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/intervation/');
    }
}
