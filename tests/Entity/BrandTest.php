<?php
namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\NfcTag;
use App\Entity\GasTypes;
use App\Entity\Location;
use App\Entity\Equipement;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BrandTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateBrand()
    {
        $brand = new Brand();
        $brand->setName('Example Brand');
        $brand->setSavNumber('12345');

        // Créez une instance d'Equipement associée à cette Brand
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
        // Set other properties...
        $brand->addEquipement($equipement);

        // Créez une instance de Model associée à cette Brand
        $model = new Model();
        $model->setName('Example Model');
        // Set other properties...
        $brand->addModel($model);

        $this->entityManager->persist($equipement);
        $this->entityManager->persist($model);
        $this->entityManager->persist($brand);
        $this->entityManager->persist($equipement);
        $this->entityManager->persist($nfcTag);
        $this->entityManager->persist($location);
        $this->entityManager->persist($gas);
        $this->entityManager->flush();

        $this->assertNotNull($brand->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
