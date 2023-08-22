<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {

            $brand = new Brand();
            $brand
                ->setName($faker->firstName())
                ->setSavNumber($faker->randomNumber())
                ->setSavLink($faker->url());

            $manager->persist($brand);
        $manager->flush();
    }
}
}