<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = \Faker\Factory::create('fr_FR');
        for($i=1; $i<=10; $i++){
            $wish = new Wish();
            $wish->setTitle($faker->sentence());
            $wish->setDescription($faker->paragraph($nbSentences = 5));
            $wish->setAuthor($faker->name());
            $wish->setIsPublished($faker->boolean(80));
            $wish->setDateCreated($faker->dateTimeBetween('-3 years', 'now', 'Europe/Paris'));
            $manager->persist($wish);
        }
        $manager->flush();
    }
}
