<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail($faker->unique()->lexify('??????@?????.com'));
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->hasher->hashPassword($user, $faker->regexify("^(?=.[0-9])(?=.[a-z])(?=.[A-Z])(?=.[!@#&()–[{}]:;',?*~$^+=<>]).{8,30}$)")));
            $user->setPseudo($faker->unique()->word());
            $manager->persist($user);
        }
        $manager->flush();
    }
}