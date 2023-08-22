<?php
namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\NfcTag;
use App\Entity\GasType;
use App\Entity\Location;
use App\Entity\equipment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GasTypeTest extends KernelTestCase
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
        $GasType = new GasType();
        $GasType->setName('CO2');
        $GasType->setEqCo2PerKg(0.5);

        // Créez une instance d'equipment associée à ce type de gaz
        $equipment = new equipment();
        $equipment->setInstallationDate(new \DateTimeImmutable());
        $equipment->setSerialNumber('12345');
        $equipment->setLocationDetail('test');
        $equipment->setProductType('clim');
        $equipment->setPlacementType('exterieur');
        $equipment->setRemoteNumber('1234');
        $equipment->setGasWeight(12,33);
        $equipment->setLeakDetection(true);
        $equipment->setNextLeakControl(new \DateTimeImmutable());
        $equipment->setFinality(1,2,3);
        $equipment->setCapacity(3 ."");
        $equipment->setPicto('https://example.com/image.png');
        $equipment->setNfc(new NfcTag);
        $equipment->setLocation(new Location);
        $equipment->setGas(new GasType);
        $equipment->setBrand(new Brand);



        // Set other properties...
        $nfcTag = new NfcTag();
        $nfcTag->setUid('example-uid'); // Set a sample UID
        $equipment->setNfc($nfcTag);

        $location = new Location();
        $location->setName('Roger');
        $equipment->setLocation($location);

        $gas = new GasType();
        $gas->setName('co2');
        $gas->setEqCo2PerKg(234);
        $equipment->setGas($gas);

        $brand = new Brand ();
        $brand->setName('test');
        $brand->setSavNumber('123456');
        $equipment->setBrand($brand);

        $equipment->setGas($GasType);

        $this->entityManager->persist($GasType);
        $this->entityManager->persist($equipment);
        $this->entityManager->persist($nfcTag);
        $this->entityManager->persist($location);
        $this->entityManager->persist($gas);
        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        $this->assertNotNull($GasType->getId());
        $this->assertNotNull($equipment->getId());
        $this->assertEquals($nfcTag->getId(), $equipment->getNfc()->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
