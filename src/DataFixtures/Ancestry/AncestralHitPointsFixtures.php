<?php

namespace App\DataFixtures\Ancestry;

use App\Entity\Ancestry\AncestralHitPoints;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AncestralHitPointsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $hitPoints6 = new AncestralHitPoints();
        $hitPoints6->setHandle(AncestralHitPoints::ANCESTRAL_HIT_POINTS_6);
        $hitPoints6->setName('6');
        $hitPoints6->setValue(-1);

        $hitPoints8 = new AncestralHitPoints();
        $hitPoints8->setHandle(AncestralHitPoints::ANCESTRAL_HIT_POINTS_8);
        $hitPoints8->setName('8');
        $hitPoints8->setValue(0);

        $hitPoints10 = new AncestralHitPoints();
        $hitPoints10->setHandle(AncestralHitPoints::ANCESTRAL_HIT_POINTS_10);
        $hitPoints10->setName('10');
        $hitPoints10->setValue(1);

        $hitPoints12 = new AncestralHitPoints();
        $hitPoints12->setHandle(AncestralHitPoints::ANCESTRAL_HIT_POINTS_12);
        $hitPoints12->setName('12');
        $hitPoints12->setValue(1);

        $manager->persist($hitPoints6);
        $manager->persist($hitPoints8);
        $manager->persist($hitPoints10);
        $manager->persist($hitPoints12);

        $manager->flush();
    }
}
