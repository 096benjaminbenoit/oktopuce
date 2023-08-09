<?php
namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\Model;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ModelTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateModel()
    {
        $model = new Model();
        $model->setName('Example Model');

        // Créez une instance de Brand associée à ce Model
        $brand = new Brand ();
        $brand->setName('test');
        $brand->setSavNumber('123456');

        $model->setBrand($brand);

        $this->entityManager->persist($brand);
        $this->entityManager->persist($model);
        $this->entityManager->flush();

        $this->assertNotNull($model->getId());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoyez les éventuelles ressources après chaque test si nécessaire
    }
}
