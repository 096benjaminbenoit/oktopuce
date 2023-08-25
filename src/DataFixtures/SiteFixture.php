<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Site;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SiteFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [ClientFixtures::class];
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $clients = $manager->getRepository(Client::class)->findAll();
        $siteReferences = [];
        for ($i = 0; $i < 5; $i++) {

            $site = new Site();
            $site
                ->setAddress($faker->address())
                ->setCity($faker->city())
                ->setPostCode($faker->postcode())
                ->setName($faker->name());

            $client = $faker->randomElement($clients);
            $site->getClient($client);
            // Configurer les attributs de Site avec Faker si nécessaire
            $manager->persist($site);
            $siteReferences[] = $site;
        }
        $manager->flush();

        $manager->flush();
    }
}
