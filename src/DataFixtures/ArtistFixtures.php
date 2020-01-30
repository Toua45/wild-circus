<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArtistFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 9; $i++ ) {
            $artist = new Artist();
            $artist->setLastname($faker->lastName);
            $artist->setFirstname($faker->firstName);
            $artist->setBirthday($faker->dateTime);
            $artist->setRole($faker->word);
            $artist->setUpdatedAt(new \DateTime());
            $artist->setImageName('');
            $artist->setRepresentation($this->getReference('representation_'. rand(0,2)));
            $artist->setCategory($this->getReference('category_'. rand(0,4)));
            $manager->persist($artist);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return class-string[]
     */
    public function getDependencies()
    {
        return [
            RepresentationFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
