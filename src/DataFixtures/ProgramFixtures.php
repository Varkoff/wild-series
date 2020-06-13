<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'The Walking Dead' => [
            'summary' => 'Sheriff Deputy Rick Grimes wakes up from a coma to learn the world is in ruins and must lead a group of survivors to stay alive.',
            'category' => 'categorie 4',
        ],
        'The Haunting of Hill House' => [
            'summary' => 'Flashing between past and present, a fractured family confronts haunting memories of their old home and the terrifying events that drove them from it.',
            'category' => 'categorie 4',
        ],
        'American Horror Story' => [
            'summary' => 'An anthology series centering on different characters and locations, including a house with a murderous past, an insane asylum, a witch coven, a freak show circus, a haunted hotel, a possessed farmhouse, a cult, the apocalypse, and a slasher summer camp.',
            'category' => 'categorie 4',
        ], 'Love, Death & Robots' => [
            'summary' => 'A collection of animated short stories that span various genres including science fiction, fantasy, horror and comedy.',
            'category' => 'categorie 4',
            'Penny Dreadful' => [
                'summary' => 'When a grisly murder shocks Los Angeles in 1938, Detective Tiago Vega and his partner Lewis Michener become embroiled in an epic story that reflects the troubled history of the city.',
                'category' => 'categorie 4',
            ],
            'Fear the Walking Dead' => [
                'summary' => 'A Walking Dead spin-off, set in Los Angeles, following two families who must band together to survive the undead apocalypse.',
                'category' => 'categorie 4',
            ]
        ]

    ];

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $faker = Factory::create();

        $i = 0;
        foreach (self::PROGRAMS as $title => $data)
        {
            $program = new Program();
            $program->setTitle($title);
            $program->setSummary($data['summary']);
            $manager->persist($program);
            $this->addReference('programme_' . $i, $program);
            $i++;
            $program->setCategory($this->getReference('categorie_4'));
        }
        for ($j= 0 + count(self::PROGRAMS); $j< 100+count(self::PROGRAMS); $j++){
            $program = new Program();
            $program->setTitle($faker->sentence(rand(1, 4), true));
            $program->setSummary($faker->sentence(10, true));
            $manager->persist($program);
            $this->addReference('programme_' . $j, $program);
            $i++;
            $program->setCategory($this->getReference('categorie_'.rand(0, 20)));
        }
        $manager->flush();
    }

}
