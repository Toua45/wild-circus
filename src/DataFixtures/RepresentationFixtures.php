<?php

namespace App\DataFixtures;

use App\Entity\Representation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class RepresentationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 2; $i++) {
            $representation = new Representation();
            $representation->setTitle($faker->word);
            $representation->setContent($faker->paragraph);
            $representation->setDate($faker->dateTime);
            $representation->setAdress($faker->address);
            $this->addReference('representation_' .$i, $representation);
            $manager->persist($representation);
        }

        $manager->flush();
    }
}
