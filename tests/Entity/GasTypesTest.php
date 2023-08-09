<?php
namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\NfcTag;
use App\Entity\GasTypes;
use App\Entity\Location;
use App\Entity\Equipement;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GasTypesTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateGasType()
    {
        $gasType = new GasTypes();
        $gasType->setName('CO2');
        $gasType->setEqCo2PerKg(0.5);

        // Créez une instance d'Equipement associée à ce type de gaz
        $equipement = new Equipement();
        $equipement->setInstallationDate(new \DateTimeImmutable());
        $equipement->setSerialNumber('12345');
        $equipement->setLocationDetail('test');
        $equipement->setProductType('clim');
        $equipement->setPlacementType('exterieur');
        $equipement->setRemoteNumber('1234');
        $equipement->setGasWeight(12,33);
        $equipement->setLeakDetection(true);
        $equipement->setNextLeakControl(new \DateTimeImmutable());
        $equipement->setFinality(1,2,3);
        $equipement->setCapacity(3 ."");
        $equipement->setPicto('https://example.com/image.png');
        $equipement->setNfc(new NfcTag);
        $equipement->setLocation(new Location);
        $equipement->setGas(new GasTypes);
        $equipement->setBrand(new Brand);



        // Set other properties...
        $nfcTag = new NfcTag();
        $nfcTag->setUid('example-uid'); // Set a sample UID
        $equipement->setNfc($nfcTag);

        $location = new Location();
        $location->setName('Roger');
        $equipement->setLocation($location);

        $gas = new GasTypes();
        $gas->setName('co2');
        $gas->setEqCo2PerKg(234);
        $equipement->setGas($gas);

        $brand = new Brand ();
        $brand->setName('test');
        $brand->setSavNumber('123456');
        $equipement->setBrand($brand);

        $equipement->setGas($gasType);

        $this->entityManager->persist($gasType);
        $this->entityManager->persist($equipement);
        $this->entityManager->persist($nfcTag);
        $this->entityManager->persist($location);
        $this->entityManager->persist($gas);
        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        $this->assertNotNull($gasType->getId());
        $this->assertNotNull($equipement->getId());
        $this->assertEquals($nfcTag->getId(), $equipement->getNfc()->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
