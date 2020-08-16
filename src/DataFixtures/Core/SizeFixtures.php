<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tinySize = new Size();
        $tinySize->setHandle(Size::SIZE_TINY);
        $tinySize->setName('Tiny');

        $smallSize = new Size();
        $smallSize->setHandle(Size::SIZE_SMALL);
        $smallSize->setName('Small');
        $smallSize->setIsPlayerCharacterSize(true);

        $mediumSize = new Size();
        $mediumSize->setHandle(Size::SIZE_MEDIUM);
        $mediumSize->setName('Medium');
        $mediumSize->setIsPlayerCharacterSize(true);

        $largeSize = new Size();
        $largeSize->setHandle(Size::SIZE_LARGE);
        $largeSize->setName('Large');

        $hugeSize = new Size();
        $hugeSize->setHandle(Size::SIZE_HUGE);
        $hugeSize->setName('Huge');

        $gargantuanSize = new Size();
        $gargantuanSize->setHandle(Size::SIZE_GARGANTUAN);
        $gargantuanSize->setName('Gargantuan');

        $manager->persist($tinySize);
        $manager->persist($smallSize);
        $manager->persist($mediumSize);
        $manager->persist($largeSize);
        $manager->persist($hugeSize);
        $manager->persist($gargantuanSize);

        $manager->flush();
    }
}
