<?php

namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\NfcTag;
use App\Entity\Person;
use App\Entity\GasType;
use App\Entity\Location;
use App\Entity\equipment;
use App\Entity\Intervention;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InterventionTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateIntervention()
    {
        $intervention = new Intervention();
        $intervention->setTechnicien('John Doe');
        $intervention->setEntreprise('ACME Corp');
        $intervention->setType('Maintenance');
        $intervention->setInterventionDate(new \DateTimeImmutable());

        // Créez une instance d'equipment associée à cette intervention
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
        $equipment->setFinality([1,2,3]);
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


        $intervention->setequipment($equipment);

        // Créez une instance de Person associée à cette intervention
        $person = new Person();
        $person->setFirstName('Jane');
        $person->setLastName('Doe');
        $person->setPhone('1234567890');
        // Set other properties...

        $intervention->setPerson($person);

        $this->entityManager->persist($intervention);
        $this->entityManager->persist($equipment);
        $this->entityManager->persist($person);
        $this->entityManager->persist($nfcTag);
        $this->entityManager->persist($location);
        $this->entityManager->persist($gas);
        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        $this->assertNotNull($intervention->getId());
        $this->assertNotNull($equipment->getId());
        $this->assertNotNull($person->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
