<?php

namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\NfcTag;
use App\Entity\GasType;
use App\Entity\Location;
use App\Entity\equipment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LocationTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateLocation()
    {
        $location = new Location();
        $location->setName('Example Location');

        // Créez une instance d'equipment associée à cette Location
        $equipment = new equipment();
        $equipment->setInstallationDate(new \DateTimeImmutable());
        $equipment->setSerialNumber('12345');
        $equipment->setLocationDetail('Location Detail');
        $equipment->setProductType('clim');
        $equipment->setPlacementType('chambre');
        $equipment->setRemoteNumber('telecommande 1234');
        $equipment->setGasWeight(2,5);
        $equipment->setLeakDetection(true);
        $equipment->setNextLeakControl(new \DateTimeImmutable());
        $equipment->setFinality(['radiateur','plancher chauffant']);
        $equipment->setCapacity(35);
        $equipment->setPicto('https://example.com/image.png');
        $equipment->setNfc(new NfcTag);
        $equipment->setLocation(new Location);
        $equipment->setGas(new GasType);
        $equipment->setBrand(new Brand);

        $nfcTag = new NfcTag();
        $nfcTag->setUid('example-uid'); // Set a sample UID
        $equipment->setNfc($nfcTag);

        $gas = new GasType();
        $gas->setName('co2');
        $gas->setEqCo2PerKg(234);
        $equipment->setGas($gas);

        $brand = new Brand ();
        $brand->setName('test');
        $brand->setSavNumber('123456');
        $equipment->setBrand($brand);
        $location->addequipment($equipment);

        $this->entityManager->persist($equipment);
        $this->entityManager->persist($location);
        $this->entityManager->persist($nfcTag);
        $this->entityManager->persist($gas);
        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        $this->assertNotNull($location->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire

    }
}
