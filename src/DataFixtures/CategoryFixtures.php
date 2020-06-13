<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use phpDocumentor\Reflection\Types\Self_;


class CategoryFixtures extends Fixture
{
    protected $faker;


    const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $this->faker = Factory::create();

        foreach (self::CATEGORIES as $key => $value)
        {
            $category = new Category();
            $category->setName($value);
            $manager->persist($category);
            $this->addReference('categorie_' . $key, $category);
        }

        for ($i = 0+count(self::CATEGORIES); $i < 20+count(self::CATEGORIES); $i++)
        {
            $category = new Category();
            $category->setName($this->faker->word());
            $manager->persist($category);
            $this->addReference('categorie_' . $i, $category);
        }
        $manager->flush();
    }
}



