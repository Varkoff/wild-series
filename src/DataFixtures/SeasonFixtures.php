<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($j = 0; $j < 500; $j++)
        {
            $season = new Season();
            $season->setYear(rand(2000, 2020));
            $season->setNumber(rand(1, 5));
            $season->setDescription($faker->sentence(10, true));
            $manager->persist($season);
            $this->addReference('saison_' . $j, $season);

            $season->setProgram($this->getReference('programme_' . rand(0, 100)));
        }
        $manager->flush();
    }

}
