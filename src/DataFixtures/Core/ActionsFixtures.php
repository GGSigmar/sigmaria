<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\Actions;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ActionsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $actionsOne = new Actions();
        $actionsOne->setHandle(Actions::ACTIONS_ONE);
        $actionsOne->setName('Jedna akcja');

        $actionsTwo = new Actions();
        $actionsTwo->setHandle(Actions::ACTIONS_TWO);
        $actionsTwo->setName('Dwie akcje');

        $actionsThree = new Actions();
        $actionsThree->setHandle(Actions::ACTIONS_THREE);
        $actionsThree->setName('Trzy akcje');

        $actionsReaction = new Actions();
        $actionsReaction->setHandle(Actions::ACTIONS_REACTION);
        $actionsReaction->setName('Reakcja');

        $actionsFree = new Actions();
        $actionsFree->setHandle(Actions::ACTIONS_FREE);
        $actionsFree->setName('Wolna akcja');

        $manager->persist($actionsOne);
        $manager->persist($actionsTwo);
        $manager->persist($actionsThree);
        $manager->persist($actionsReaction);
        $manager->persist($actionsFree);

        $manager->flush();
    }
}
