<?php

use App\Entity\Users;
use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class UsersTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreateUser()
    {
        $user = new Users();
        $user->setPhone('1234567890');
        $user->setPassword('test');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER', 'ROLE_TECHNICIEN']);

        $person = new Person();
        $person->setFirstName('fatima');
        $person->setLastName('yakhlef');
        $person->setPhone('1234567890');
        $user->setPerson($person);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->assertNotNull($user->getId());
        $this->assertNotNull($user->getPerson());
    }

    public function testUserPhone()
    {
        $user = new Users();
        $user->setPhone('1234567890');

        $this->assertSame('1234567890', $user->getPhone());
    }

    public function testUserRoles()
    {
        $user = new Users();
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER', 'ROLE_TECHNICIEN']);

        $this->assertSame(['ROLE_ADMIN', 'ROLE_USER', 'ROLE_TECHNICIEN'], $user->getRoles());
    }
    

}
