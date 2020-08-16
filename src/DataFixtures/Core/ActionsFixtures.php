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
        $actionsOne->setName('One Action');

        $actionsTwo = new Actions();
        $actionsTwo->setHandle(Actions::ACTIONS_TWO);
        $actionsTwo->setName('Two Actions');

        $actionsThree = new Actions();
        $actionsThree->setHandle(Actions::ACTIONS_THREE);
        $actionsThree->setName('Three Actions');

        $actionsReaction = new Actions();
        $actionsReaction->setHandle(Actions::ACTIONS_REACTION);
        $actionsReaction->setName('Reaction');

        $actionsFree = new Actions();
        $actionsFree->setHandle(Actions::ACTIONS_FREE);
        $actionsFree->setName('Free Action');

        $manager->persist($actionsOne);
        $manager->persist($actionsTwo);
        $manager->persist($actionsThree);
        $manager->persist($actionsReaction);
        $manager->persist($actionsFree);

        $manager->flush();
    }
}
