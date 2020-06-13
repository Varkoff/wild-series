<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($j = 0; $j < 2500; $j++)
        {
            $episode = new Episode();
            $episode->setNumber(rand(1, 5));
            $episode->setTitle($faker->sentence(5, true));
            $episode->setSynopsis($faker->sentence(5, true));
            $manager->persist($episode);
            //$this->addReference('epsiode_' . $j, $episode);

            $episode->setSeason($this->getReference('saison_' . rand(0, 499)));
        }
        $manager->flush();
    }

}
