<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $smallSize = new Size();
        $smallSize->setHandle(Size::SIZE_SMALL);
        $smallSize->setName('Mały');

        $mediumSize = new Size();
        $mediumSize->setHandle(Size::SIZE_MEDIUM);
        $mediumSize->setName('Średni');

        $manager->persist($smallSize);
        $manager->persist($mediumSize);

        $manager->flush();
    }
}
