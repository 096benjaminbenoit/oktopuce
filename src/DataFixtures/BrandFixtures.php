<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class BrandFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $brand_names = [
            "ADVANTIX",
            "AERMEC",
            "AIRTON",
            "AIRWELL",
            "ALDES",
            "ALTECH",
            "AMBITHERMEUR",
            "ARISTON",
            "ATLANTIC",
            "AUX",
            "BAXI",
            "CAPR AIR",
            "CARRERA",
            "CARRIER",
            "CASTORAMA",
            "CIAT",
            "CHAPPEE",
            "DAIKIN",
            "ELECTRA",
            "FIRSTLINE",
            "FUJITSU ATLANTIC",
            "FUJITSU GENERAL",
            "GENERAL",
            "GENERAL ELECTRIC",
            "GREE",
            "HAIR",
            "HEIWA",
            "HITACHI",
            "LG",
            "MASTERCOOL",
            "MIDEA",
            "MITSUBISHI",
            "MITSUBISHI HEAVY",
            "MUTIGENE",
            "NCP",
            "OKKAIDO",
            "PANASONIC",
            "QLIMA",
            "SAMSUNG",
            "SANGHA",
            "SANYO",
            "SAUNIER DUVAL",
            "SINUDYNE",
            "TECHNIBEL",
            "TECTRO",
            "TOSHIBA",
            "TRANE",
            "UNICO",
            "WESPER",
            "WHIRLPOOL",
            "WINCO",
            "YOKOHAMA",
            "ZENITH",
            "ZENITH AIR",
            "ZHENDRE",
            "ZIBRO",
        ];

        foreach ($brand_names as $brand_name) {
            $brand = new Brand();
            $brand
                ->setName($brand_name)
                ;

            $manager->persist($brand);
            $manager->flush();
        }
    }

    public static function getGroups(): array {
        return ["real"];
    }
}
