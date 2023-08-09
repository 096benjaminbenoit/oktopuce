<?php

namespace App\DataFixtures;

use App\Entity\GasTypes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class GasTypesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for ($i = 0 ; $i < 8 ;$i++)
        {
            $gasTypes = new GasTypes();
            $gasTypes->setName($faker->firstName);
            $gasTypes->setEqCo2PerKg($faker->randomDigit);
            $manager->persist($gasTypes);

             
        }
        $manager->flush();
    }

    //apres dans le terminale :   bin/console doctrine:fixtures:load
}
