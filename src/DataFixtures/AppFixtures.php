<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Wish;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
/*
    private $categoryRepository;
    public function __construct(){
        $this->categoryRepository = CategoryRepository::class;
    }
*/
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
           // $wish->setCategory(CategoryRepository::find(rand(1,5)));

            $manager->persist($wish);
        }
        $manager->flush();
    }
}
