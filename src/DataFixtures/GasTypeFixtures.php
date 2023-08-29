<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\GasType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GasTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $gas_types = [
            ["R-134A", 1430],
            ["R-22",   1810],
            ["R-407C", 1800],
            ["R-410A", 2100],
            ["R-32",    675],
        ];

        foreach ($gas_types as [$name, $co2perkg])
        {
            $GasType = new GasType();
            $GasType->setName($name);
            $GasType->setEqCo2PerKg($co2perkg);

            $manager->persist($GasType); 
        }
        $manager->flush();
    }

    //apres dans le terminale :   bin/console doctrine:fixtures:load
}
