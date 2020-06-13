<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;


class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Andrew Lincoln' => [
            'name' => 'Andrew',
            'lastname' => 'Lincoln',
            'program' => ['programme 0', 'programme 5']
        ],
        'Norman Reedus' => [
            'name' => 'Norman',
            'lastname' => 'Reedus',
            'program' => ['programme 0']
        ],
    ];

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $faker = Factory::create();
        $i = 0;
        foreach (self::ACTORS as $key => $data)
        {
            $actor = new Actor();
            $actor->setName($data['name']);
            $actor->setLastname($data['lastname']);
            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor);
            $i++;
            $actor->addProgram($this->getReference('programme_0'));
        }

        for ($j = 0 + count(self::ACTORS); $j < 1000 + count(self::ACTORS); $j++)
        {
            $actor = new Actor();
            $actor->setName($faker->name);
            $actor->setLastname($faker->lastName);
            $manager->persist($actor);
            $this->addReference('actor_' . $j, $actor);
            $i++;
            $actor->addProgram($this->getReference('programme_' . rand(0, 99)));
        }
        $manager->flush();
    }

}
