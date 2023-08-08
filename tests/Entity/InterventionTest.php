<?php
namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\NfcTag;
use App\Entity\Person;
use App\Entity\GasTypes;
use App\Entity\Location;
use App\Entity\Equipement;
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

        // Créez une instance d'Equipement associée à cette intervention
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
        $equipement->setFinality([1,2,3]);
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


        $intervention->setEquipement($equipement);

        // Créez une instance de Person associée à cette intervention
        $person = new Person();
        $person->setFirstName('Jane');
        $person->setLastName('Doe');
        $person->setPhone('1234567890');
        // Set other properties...

        $intervention->setPerson($person);

        $this->entityManager->persist($intervention);
        $this->entityManager->persist($equipement);
        $this->entityManager->persist($person);
        $this->entityManager->persist($nfcTag);
        $this->entityManager->persist($location);
        $this->entityManager->persist($gas);
        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        $this->assertNotNull($intervention->getId());
        $this->assertNotNull($equipement->getId());
        $this->assertNotNull($person->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
