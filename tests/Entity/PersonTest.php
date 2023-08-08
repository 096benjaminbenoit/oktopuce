<?php
namespace App\Tests\Entity;

use App\Entity\Person;
use App\Entity\Users;
use App\Entity\Intervention;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PersonTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCreatePerson()
    {
        $person = new Person();
        $person->setLastName('John Doe');
        $person->setFirstName('fatima');
        $person->setPhone('1234567890');

        // Create and associate a Users
        $user = new Users();
        $user->setPhone('1234567890');
        $user->setPassword('test');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER', 'ROLE_TECHNICIEN']);
        $person->setUsers($user);

        $this->entityManager->persist($person);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->assertNotNull($person->getId());
        $this->assertNotNull($user->getId());
    }

    // Add more test cases for adding/removing interventions if needed

    protected function tearDown(): void
    {
        parent::tearDown();

        // Clean up resources, if necessary
    }
}
