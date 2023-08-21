<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setPhone('+33610159678')
            ->setPassword(
                $this->hasher->hashPassword(
                    $user,
                    'test'
                )
            )
        ;

        $manager->persist($user);

        $manager->flush();
    }
}
