<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\MoveSpeed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MoveSpeedFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $speed20 = new MoveSpeed();
        $speed20->setHandle(MoveSpeed::MOVE_SPEED_20);
        $speed20->setName('20');
        $speed20->setValue(-1);

        $speed25 = new MoveSpeed();
        $speed25->setHandle(MoveSpeed::MOVE_SPEED_25);
        $speed25->setName('25');
        $speed25->setValue(0);

        $speed30 = new MoveSpeed();
        $speed30->setHandle(MoveSpeed::MOVE_SPEED_30);
        $speed30->setName('30');
        $speed30->setValue(1);

        $manager->persist($speed20);
        $manager->persist($speed25);
        $manager->persist($speed30);

        $manager->flush();
    }
}
