<?php

namespace App\Tests\Entity;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Equipment;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    public function testSetName()
    {
        $brand = new Brand();
        $name = "Example Brand";
        $brand->setName($name);

        $this->assertEquals($name, $brand->getName());
    }
    

    public function testSetSavNumber()
    {
        $brand = new Brand();
        $savNumber = "12345";
        $brand->setSavNumber($savNumber);

        $this->assertEquals($savNumber, $brand->getSavNumber());
    }

    public function testSetSavLink()
    {
        $brand = new Brand();
        $savLink = "https://example.com";
        $brand->setSavLink($savLink);

        $this->assertEquals($savLink, $brand->getSavLink());
    }

    public function testAddModel()
    {
        $brand = new Brand();
        $model = new Model();

        $brand->addModel($model);

        $this->assertTrue($brand->getModels()->contains($model));
        $this->assertSame($brand, $model->getBrand());
    }

    public function testRemoveModel()
    {
        $brand = new Brand();
        $model = new Model();

        $brand->addModel($model);
        $brand->removeModel($model);

        $this->assertFalse($brand->getModels()->contains($model));
        $this->assertNull($model->getBrand());
    }

    public function testAddEquipment()
    {
        $brand = new Brand();
        $equipment = new Equipment();

        $brand->addEquipment($equipment);

        $this->assertTrue($brand->getEquipment()->contains($equipment));
        $this->assertSame($brand, $equipment->getBrand());
    }

    public function testRemoveEquipment()
    {
        $brand = new Brand();
        $equipment = new Equipment();

        $brand->addEquipment($equipment);
        $brand->removeEquipment($equipment);

        $this->assertFalse($brand->getEquipment()->contains($equipment));
        $this->assertNull($equipment->getBrand());
    }
}
