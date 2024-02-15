<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const array PROGRAM = [
        [
            'Walking dead',
            'Des zombies envahissent la terre',
            'category_Action'
        ],
        [
            'Foundation',
            'Le futur est compliqué',
            'category_Aventure'
        ],
        [
            'Arcanes',
            'LOL en animé!',
            'category_Animation'
        ],
        [
            'Sons of anarchy',
            'Des gens en moto',
            'category_Action'
        ],
        [
            'Battlestar Galactica',
            'Des gens dans l\'espace',
            'category_Action'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAM as [$title, $synopsys, $category]) {
            $program = new Program();
            $program->setTitle($title);
            $program->setSynopsis($synopsys);
            $program->setCategory($this->getReference($category));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
