<?php
use App\Entity\Location;
use App\Entity\Equipment;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testLocationAttributes(): void
    {
        $location = new Location();

        $name = "Room A";
        $location->setName($name);
        $this->assertSame($name, $location->getName());
    }

    public function testLocationEquipmentCollection(): void
    {
        $location = new Location();

        $equipment1 = new Equipment();
        $equipment2 = new Equipment();

        $location->addEquipment($equipment1);
        $location->addEquipment($equipment2);

        $equipmentCollection = $location->getEquipment();
        $this->assertCount(2, $equipmentCollection);
        $this->assertTrue($equipmentCollection->contains($equipment1));
        $this->assertTrue($equipmentCollection->contains($equipment2));

        $location->removeEquipment($equipment1);
        $this->assertCount(1, $location->getEquipment());
        $this->assertFalse($location->getEquipment()->contains($equipment1));
    }
}
