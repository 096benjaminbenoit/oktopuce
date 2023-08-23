<?php
use App\Entity\GasType;
use App\Entity\Equipment;
use PHPUnit\Framework\TestCase;

class GasTypeTest extends TestCase
{
    public function testGasTypeAttributes(): void
    {
        $gasType = new GasType();

        $name = "Oxygen";
        $gasType->setName($name);
        $this->assertSame($name, $gasType->getName());

        $eqCo2PerKg = 0.3;
        $gasType->setEqCo2PerKg($eqCo2PerKg);
        $this->assertSame($eqCo2PerKg, $gasType->getEqCo2PerKg());
    }

    public function testGasTypeEquipmentCollection(): void
    {
        $gasType = new GasType();

        $equipment1 = new Equipment();
        $equipment2 = new Equipment();

        $gasType->addEquipment($equipment1);
        $gasType->addEquipment($equipment2);

        $equipmentCollection = $gasType->getEquipment();
        $this->assertCount(2, $equipmentCollection);
        $this->assertTrue($equipmentCollection->contains($equipment1));
        $this->assertTrue($equipmentCollection->contains($equipment2));

        $gasType->removeEquipment($equipment1);
        $this->assertCount(1, $gasType->getEquipment());
        $this->assertFalse($equipmentCollection->contains($equipment1));
    }

    // ... Add more test methods to cover other behaviors
}
