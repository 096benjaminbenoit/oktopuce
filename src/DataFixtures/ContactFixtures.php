<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Site;
use App\Entity\Contact;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [SiteFixture::class];
    }

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
