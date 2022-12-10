<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i <= 10; $i++)
        {
            $customer = new Customer();
            $customer->setEmail($faker->email());
            $customer->setFirstname($faker->firstName);
            $customer->setLastname($faker->lastName);
            $customer->setRoles(['ROLE_ADMIN']);
            $customer->setPassword($this->hasher->hashPassword($customer, 'Customer-'. $i));

            $manager->persist($customer);
        }

        $manager->flush();
    }
}
