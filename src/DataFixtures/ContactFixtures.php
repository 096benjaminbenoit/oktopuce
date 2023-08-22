<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Site;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $positions = [
            'Directeur',
            'Manager',
            'Chef de projet',
            'Assistant',
            'Agent d\'entretien',
            'Concierge',
            'Technicien',
            'Ingénieur',
            'Commercial',
            'Responsable des ressources humaines'
        ];
        $sites = $manager->getRepository(Site::class)->findAll();
        $clients = $manager->getRepository(Client::class)->findAll();

        $siteReferences = [];
        for ($i = 0; $i < 5; $i++){

            $site = new Site();
            $site
            ->setAddress($faker->address())
            ->setCity($faker->city())
            ->setPostCode($faker->postcode())
            ->setName($faker->name())
            ->setClient($faker->client());

            $client = $faker->randomElement($clients);
            $site ->getClient($client);
            // Configurer les attributs de Site avec Faker si nécessaire
            $manager->persist($site);
            $siteReferences[] = $site;

        }
        $manager->flush();


        for ($i = 0; $i < 10; $i++) {

            $contact = new Contact();
            $contact
            ->setLastName($faker->lastName())
            ->setFirstName($faker->firstName())
            ->setPhone($faker->phoneNumber())
            ->setEmail($faker->email())
            ->setPosition($faker->randomElement($positions));

            $randomSites = $faker->randomElements($sites, $faker->numberBetween(1, 3)); // Choisissez un nombre aléatoire de sites
            foreach ($randomSites as $site) {
                $contact->addSite($site);
            }
            $manager->persist($contact);
        


        $manager->flush();
    }
}
}