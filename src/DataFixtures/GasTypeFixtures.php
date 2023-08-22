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
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for ($i = 0 ; $i < 8 ;$i++)
        {
            $GasType = new GasType();
            $GasType->setName($faker->firstName);
            $GasType->setEqCo2PerKg($faker->randomDigit);
            $manager->persist($GasType);

             
        }
        $manager->flush();
    }

    //apres dans le terminale :   bin/console doctrine:fixtures:load
}
