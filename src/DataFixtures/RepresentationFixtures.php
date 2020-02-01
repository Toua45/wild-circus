<?php

namespace App\DataFixtures;

use App\Entity\Representation;
use App\Entity\RepresentationLike;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RepresentationFixtures extends Fixture
{
    /**
     * Encodeur de mot de passe
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $users = [];

        $user = new User();
        $user->setEmail('user@symfony.com')
            ->setPassword($this->encoder->encodePassword($user, 'password'));

        $manager->persist($user);

        $users[] = $user;

        for ($i = 0; $i < 8; $i++) {
            $user = new User();
            $user->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, 'password'));

            $manager->persist($user);

            $users[] = $user;
        }

        for ($i = 0; $i <= 2; $i++) {
            $representation = new Representation();
            $representation->setTitle($faker->word);
            $representation->setContent($faker->paragraph);
            $representation->setDate($faker->dateTime);
            $representation->setAdress($faker->address);
            $this->addReference('representation_' .$i, $representation);
            $manager->persist($representation);

            for ($j = 0; $j < mt_rand(0, 8); $j++) {
                $like = new RepresentationLike();
                $like->setRepresentation($representation)
                    ->setUser($faker->randomElement($users));

                $manager->persist($like);
            }
        }

        $manager->flush();
    }
}
