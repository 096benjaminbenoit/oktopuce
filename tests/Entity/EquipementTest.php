<?php
namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\NfcTag;
use App\Entity\GasTypes;
use App\Entity\Location;
use App\Entity\equipment;
use App\Entity\Intervention;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class equipmentTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateequipment()
    {
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
        $equipment->setFinality('radiateur','plancher chauffant');
        $equipment->setCapacity(35);
        $equipment->setPicto('https://example.com/image.png');
        $equipment->setNfc(new NfcTag);
        $equipment->setLocation(new Location);
        $equipment->setGas(new GasTypes);
        $equipment->setBrand(new Brand);

        $nfcTag = new NfcTag();
        $nfcTag->setUid('example-uid'); // Set a sample UID
        $equipment->setNfc($nfcTag);

        $location = new Location();
        $location->setName('Roger');
        $equipment->setLocation($location);

        $gas = new GasTypes();
        $gas->setName('co2');
        $gas->setEqCo2PerKg(234);
        $equipment->setGas($gas);

        $brand = new Brand ();
        $brand->setName('test');
        $brand->setSavNumber('123456');
        $equipment->setBrand($brand);

        $this->entityManager->persist($equipment);
        $this->entityManager->persist($nfcTag);
        $this->entityManager->persist($location);
        $this->entityManager->persist($gas);
        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        $this->assertNotNull($equipment->getId());
        $this->assertEquals($nfcTag->getId(), $equipment->getNfc()->getId());
    }

    public function testAddRemoveIntervention()
    {
        $equipment = new equipment();
        $equipment->setInstallationDate(new \DateTimeImmutable());
        $equipment->setSerialNumber('12345');
        $equipment->setLocationDetail('Location Detail');
        

        $intervention = new Intervention();
        // Set intervention properties...

        $equipment->addIntervention($intervention);

        $this->assertCount(1, $equipment->getIntervention());

        $equipment->removeIntervention($intervention);

        $this->assertCount(0, $equipment->getIntervention());
    }

    public function testAddRemoveequipment()
    {
        $parentequipment = new equipment();
        $parentequipment->setInstallationDate(new \DateTimeImmutable());
        $parentequipment->setSerialNumber('ParentEquip');
        $parentequipment->setLocationDetail('Parent Location Detail');
        // Set other properties...

        $childequipment = new equipment();
        $childequipment->setInstallationDate(new \DateTimeImmutable());
        $childequipment->setSerialNumber('ChildEquip');
        $childequipment->setLocationDetail('Child Location Detail');
        // Set other properties...

        $parentequipment->addequipment($childequipment);

        $this->assertCount(1, $parentequipment->getequipments());

        $parentequipment->removeequipment($childequipment);

        $this->assertCount(0, $parentequipment->getequipments());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
