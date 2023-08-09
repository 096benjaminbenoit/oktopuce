<?php
namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\NfcTag;
use App\Entity\GasTypes;
use App\Entity\Location;
use App\Entity\Equipement;
use App\Entity\Intervention;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EquipementTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateEquipement()
    {
        $equipement = new Equipement();
        $equipement->setInstallationDate(new \DateTimeImmutable());
        $equipement->setSerialNumber('12345');
        $equipement->setLocationDetail('Location Detail');
        $equipement->setProductType('clim');
        $equipement->setPlacementType('chambre');
        $equipement->setRemoteNumber('telecommande 1234');
        $equipement->setGasWeight(2,5);
        $equipement->setLeakDetection(true);
        $equipement->setNextLeakControl(new \DateTimeImmutable());
        $equipement->setFinality(['radiateur','plancher chauffant']);
        $equipement->setCapacity(35);
        $equipement->setPicto('https://example.com/image.png');
        $equipement->setNfc(new NfcTag);
        $equipement->setLocation(new Location);
        $equipement->setGas(new GasTypes);
        $equipement->setBrand(new Brand);

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

        $this->entityManager->persist($equipement);
        $this->entityManager->persist($nfcTag);
        $this->entityManager->persist($location);
        $this->entityManager->persist($gas);
        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        $this->assertNotNull($equipement->getId());
        $this->assertEquals($nfcTag->getId(), $equipement->getNfc()->getId());
    }

    public function testAddRemoveIntervention()
    {
        $equipement = new Equipement();
        $equipement->setInstallationDate(new \DateTimeImmutable());
        $equipement->setSerialNumber('12345');
        $equipement->setLocationDetail('Location Detail');
        

        $intervention = new Intervention();
        // Set intervention properties...

        $equipement->addIntervention($intervention);

        $this->assertCount(1, $equipement->getIntervention());

        $equipement->removeIntervention($intervention);

        $this->assertCount(0, $equipement->getIntervention());
    }

    public function testAddRemoveEquipement()
    {
        $parentEquipement = new Equipement();
        $parentEquipement->setInstallationDate(new \DateTimeImmutable());
        $parentEquipement->setSerialNumber('ParentEquip');
        $parentEquipement->setLocationDetail('Parent Location Detail');
        // Set other properties...

        $childEquipement = new Equipement();
        $childEquipement->setInstallationDate(new \DateTimeImmutable());
        $childEquipement->setSerialNumber('ChildEquip');
        $childEquipement->setLocationDetail('Child Location Detail');
        // Set other properties...

        $parentEquipement->addEquipement($childEquipement);

        $this->assertCount(1, $parentEquipement->getEquipements());

        $parentEquipement->removeEquipement($childEquipement);

        $this->assertCount(0, $parentEquipement->getEquipements());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
