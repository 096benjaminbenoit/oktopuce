<?php

use App\Entity\Intervention;
use App\Entity\Person;
use App\Entity\Equipment;
use PHPUnit\Framework\TestCase;

class InterventionTest extends TestCase
{
    public function testInterventionAttributes(): void
    {
        $intervention = new Intervention();

        $technician = "John Doe";
        $intervention->setTechnician($technician);
        $this->assertSame($technician, $intervention->getTechnician());

        $enterprise = "ABC Company";
        $intervention->setEnterprise($enterprise);
        $this->assertSame($enterprise, $intervention->getEnterprise());

        $person = new Person();
        $intervention->setPerson($person);
        $this->assertSame($person, $intervention->getPerson());

        $equipment = new Equipment();
        $intervention->setEquipment($equipment);
        $this->assertSame($equipment, $intervention->getEquipment());

        $response = ['question' => 'answer'];
        $intervention->setResponse($response);
        $this->assertSame($response, $intervention->getResponse());
    }
}
