<?php

use App\Entity\Equipment;
use App\Entity\NfcTag;
use App\Entity\Finality;
use PHPUnit\Framework\TestCase;

class EquipmentTest extends TestCase
{
    public function testEquipmentAttributes(): void
    {
        $equipment = new Equipment();

        $installationDate = new \DateTimeImmutable();
        $equipment->setInstallationDate($installationDate);
        $this->assertSame($installationDate, $equipment->getInstallationDate());

        $serialNumber = "ABC123";
        $equipment->setSerialNumber($serialNumber);
        $this->assertSame($serialNumber, $equipment->getSerialNumber());

        $parentEquipment = new Equipment();
        $equipment->setParent($parentEquipment);
        $this->assertSame($parentEquipment, $equipment->getParent());

        
        // ... continue setting and getting attributes for other properties

        $this->assertNull($equipment->getNfcTag()); // Check for null value
        $this->assertNull($equipment->getBrand()); // Check for null value
        $this->assertNull($equipment->getLocation()); // Check for null value

        // ... assert for other associations

        // ... continue testing other methods
    }
    public function testEquipmentNfcTag(): void
    {
        $equipment = new Equipment();

        // Vérifie que l'étiquette NFC est initialisée à null par défaut
        $this->assertNull($equipment->getNfcTag());

        // Crée une instance de NfcTag
        $nfcTag = new NfcTag();

        // Définit l'étiquette NFC sur l'équipement
        $equipment->setNfcTag($nfcTag);

        // Vérifie que l'étiquette NFC est bien définie et correspondante
        $this->assertSame($nfcTag, $equipment->getNfcTag());

        // Supprime l'étiquette NFC de l'équipement
        $equipment->setNfcTag(null);

        // Vérifie que l'étiquette NFC est maintenant à null
        $this->assertNull($equipment->getNfcTag());
    }

        public function testEquipmentFinalityCollection(): void
        {
            $equipment = new Equipment();

            $finality1 = new Finality();
            $finality2 = new Finality();

            $equipment->addFinality($finality1);
            $equipment->addFinality($finality2);

            $finalities = $equipment->getFinality();
            $this->assertCount(2, $finalities);
            $this->assertTrue($finalities->contains($finality1));
            $this->assertTrue($finalities->contains($finality2));

            $equipment->removeFinality($finality1);
            $this->assertCount(1, $equipment->getFinality());
            $this->assertFalse($equipment->getFinality()->contains($finality1));
        }

    //     // ... Add more test methods to cover other behaviors

}
