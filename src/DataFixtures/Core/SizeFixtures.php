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
        $tinySize->setName('Drobny');

        $smallSize = new Size();
        $smallSize->setHandle(Size::SIZE_SMALL);
        $smallSize->setName('Mały');
        $smallSize->setIsPlayerCharacterSize(true);

        $mediumSize = new Size();
        $mediumSize->setHandle(Size::SIZE_MEDIUM);
        $mediumSize->setName('Średni');
        $mediumSize->setIsPlayerCharacterSize(true);

        $largeSize = new Size();
        $largeSize->setHandle(Size::SIZE_LARGE);
        $largeSize->setName('Duży');

        $hugeSize = new Size();
        $hugeSize->setHandle(Size::SIZE_HUGE);
        $hugeSize->setName('Wielki');

        $gargantuanSize = new Size();
        $gargantuanSize->setHandle(Size::SIZE_GARGANTUAN);
        $gargantuanSize->setName('Ogromny');

        $manager->persist($tinySize);
        $manager->persist($smallSize);
        $manager->persist($mediumSize);
        $manager->persist($largeSize);
        $manager->persist($hugeSize);
        $manager->persist($gargantuanSize);

        $manager->flush();
    }
}
