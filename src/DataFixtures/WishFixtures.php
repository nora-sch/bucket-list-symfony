<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Wish;
use App\DataFixtures\UserFixtures;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WishFixtures extends Fixture implements DependentFixtureInterface
 //class WishFixtures extends Fixture
{

    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

     public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $categories = $this->categoryRepository->findAll();
        for($i=1; $i<=10; $i++){
            $wish = new Wish();
            $wish->setTitle($faker->sentence());
            $wish->setDescription($faker->paragraph($nbSentences = 5));
            $wish->setAuthor($faker->name());
            $wish->setIsPublished($faker->boolean(80));
            $wish->setDateCreated($faker->dateTimeBetween('-3 years', 'now', 'Europe/Paris'));
          //  $wish->setCategory(CategoryRepository::find(rand(1,5)));
            $wish->setCategory($faker->randomElement($categories));
            $manager->persist($wish);
        }
        $manager->flush();
    }

    /*public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return[UserFixtures::class, CategorieFixtures::class];
    }*/
        public function getDependencies()
    {
        return[UserFixtures::class];
    }
}
