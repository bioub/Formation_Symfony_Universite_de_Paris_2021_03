<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $company = new Company();
        $company->setName('Apple');
        $manager->persist($company);

        for ($i=0; $i<10; $i++) {
            $contact = new Contact();
            $contact->setFirstName($faker->firstName())->setLastName($faker->lastName);
            $manager->persist($contact);

            $contact->setCompany($company);
        }



        $manager->flush();
    }
}
