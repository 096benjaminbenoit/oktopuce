<?php

namespace App\Tests\Services;

use App\Entity\equipment;
use App\Entity\GasType;
use App\Services\LeakControlCalculator;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LeakControlCalculatorTest extends WebTestCase
{
    private function getEquipment($gasEqCO2PerKg = 675, $gasWeight = 1.6, $isLeakDetection = true)
    {
        return (new equipment)
            ->setGasWeight($gasWeight)
            ->setLeakDetection($isLeakDetection)
            ->setLastLeakDetection(new \DateTimeImmutable('now'))
            ->setGas(
                (new GasType())
                    ->setEqCo2PerKg($gasEqCO2PerKg)
            )
        ;
    }

    public function testClassExist(): void
    {
        $this->assertTrue(class_exists(LeakControlCalculator::class));
    }

    public function testReturnDateTimeImmutable(): void
    {
        $equipment = $this->getEquipment(2100, 2.6, false);
        $this->assertInstanceOf(\DateTimeImmutable::class, LeakControlCalculator::getNextLeakControlDate($equipment));
    }

    public function testCalculTCO2(): void
    {
        // Si machine contient 1.6 Kg de gaz R32 ALORS t Eq. CO2 = 1.6 x 675 = 1080 Kg < 5t donc pas
        // d’obligation
        $equipment = $this->getEquipment(675, 1.6);
        $this->assertEquals(LeakControlCalculator::calculTCO2($equipment), 1080);

        // Si machine contient 2.6 Kg de gaz R410A ALORS t Eq. CO2 = 2.6 x 2100 = 5460 Kg > 5t donc
        // contrôle d’étanchéité obligatoire 1 fois par an
        $equipment = $this->getEquipment(2100, 2.6);
        $this->assertEquals(LeakControlCalculator::calculTCO2($equipment), 5460);
    }

    public function testControlIsMandatory(): void
    {
        // Si machine contient 1.6 Kg de gaz R32 ALORS t Eq. CO2 = 1.6 x 675 = 1080 Kg < 5t donc pas
        // d’obligation
        $equipment = $this->getEquipment(675, 1.6, true);
        $this->assertFalse(LeakControlCalculator::isControlMandatory($equipment));

        // Si machine contient 2.6 Kg de gaz R410A ALORS t Eq. CO2 = 2.6 x 2100 = 5460 Kg > 5t donc
        // contrôle d’étanchéité obligatoire 1 fois par an
        $equipment = $this->getEquipment(2100, 2.6, false);
        $this->assertTrue(LeakControlCalculator::isControlMandatory($equipment));
    }

    public function testPeriodicity(): void
    {
        $equipment = $this->getEquipment(2100, 2.6, false);
        $this->assertEquals('+ 6 months', LeakControlCalculator::getPeriodicity($equipment));

        $equipment = $this->getEquipment(2100, 2.6, true);
        $this->assertEquals('+ 2 years', LeakControlCalculator::getPeriodicity($equipment));
    }

    public function testNextControlDate(): void
    {
        $equipment = $this->getEquipment(675, 1.6, true);
        $this->assertNull(LeakControlCalculator::getNextLeakControlDate($equipment, new DateTimeImmutable("now")));

        $equipment = $this->getEquipment(2100, 2.6, false);
        $this->assertEquals((new \DateTimeImmutable('now + 6 months'))->format("d/m/Y"), LeakControlCalculator::getNextLeakControlDate($equipment, new DateTimeImmutable("now"))->format('d/m/Y'));

        $equipment = $this->getEquipment(2100, 2.6, true);
        $this->assertEquals((new \DateTimeImmutable('now + 2 years'))->format("d/m/Y"), LeakControlCalculator::getNextLeakControlDate($equipment, new DateTimeImmutable("now"))->format('d/m/Y'));
    }
}
