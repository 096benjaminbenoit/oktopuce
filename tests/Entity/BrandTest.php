<?php
namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\NfcTag;
use App\Entity\GasTypes;
use App\Entity\Location;
use App\Entity\equipment;
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

        // Créez une instance d'equipment associée à cette Brand
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
        $equipment->setGas(new GasTypes);

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
        // Set other properties...
        $brand->addequipment($equipment);

        // Créez une instance de Model associée à cette Brand
        $model = new Model();
        $model->setName('Example Model');
        // Set other properties...
        $brand->addModel($model);

        $this->entityManager->persist($equipment);
        $this->entityManager->persist($model);
        $this->entityManager->persist($brand);
        $this->entityManager->persist($equipment);
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
