<?php
namespace App\Tests\Entity;

use App\Entity\NfcTag;
use Doctrine\DBAL\Types\Types;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class NfcTagTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateNfcTag()
    {
        $nfcTag = new NfcTag();
        $nfcTag->setUid('example-uid');

        $this->entityManager->persist($nfcTag);
        $this->entityManager->flush();

        $this->assertNotNull($nfcTag->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Clean up resources, if necessary
    }
}
