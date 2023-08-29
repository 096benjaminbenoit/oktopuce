<?php
use App\Entity\Finality;
use App\Entity\Equipment;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class FinalityTest extends TestCase
{
    public function testFinalityAttributes(): void
    {
        $finality = new Finality();

        $name = "Office";
        $finality->setName($name);
        $this->assertSame($name, $finality->getName());

        // ... continue setting and getting attributes for other properties

        $this->assertInstanceOf(ArrayCollection::class, $finality->getEquipment());
        $this->assertCount(0, $finality->getEquipment());

        $equipment = new Equipment();
        $finality->addEquipment($equipment);

        $equipmentCollection = $finality->getEquipment();
        $this->assertCount(1, $equipmentCollection);
        $this->assertTrue($equipmentCollection->contains($equipment));

        $finality->removeEquipment($equipment);
        $this->assertCount(0, $finality->getEquipment());
        $this->assertFalse($equipmentCollection->contains($equipment));

        // ... continue testing other methods
    }

    // ... Add more test methods to cover other behaviors
}
