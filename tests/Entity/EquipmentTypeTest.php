<?php
use App\Entity\EquipmentType;
use App\Entity\Equipment;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class EquipmentTypeTest extends TestCase
{
    public function testEquipmentTypeAttributes(): void
    {
        $equipmentType = new EquipmentType();

        $type = "Computer";
        $equipmentType->setType($type);
        $this->assertSame($type, $equipmentType->getType());

        // ... continue setting and getting attributes for other properties

        $this->assertInstanceOf(ArrayCollection::class, $equipmentType->getEquipment());
        $this->assertCount(0, $equipmentType->getEquipment());

        $equipment = new Equipment();
        $equipmentType->addEquipment($equipment);

        $equipmentCollection = $equipmentType->getEquipment();
        $this->assertCount(1, $equipmentCollection);
        $this->assertTrue($equipmentCollection->contains($equipment));

        $equipmentType->removeEquipment($equipment);
        $this->assertCount(0, $equipmentType->getEquipment());
        $this->assertFalse($equipmentCollection->contains($equipment));

        // ... continue testing other methods
    }

    // ... Add more test methods to cover other behaviors
}
