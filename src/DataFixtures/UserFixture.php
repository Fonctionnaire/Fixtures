<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\CustomerRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class UserFixture extends Fixture
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');


            foreach ($this->customerRepository->findAll() as $customer)
            {
                for($i = 0; $i <= 20; $i++)
                {
                    $user = new User();
                    $user->setFirstname($faker->firstName);
                    $user->setLastname($faker->lastName);
                    $user->setEmail($faker->email);
                    $user->setCustomer($customer);

                    $manager->persist($user);
                }
            }

        $manager->flush();

    }
}
