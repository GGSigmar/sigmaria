<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\Rarity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RarityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $commonRarity = new Rarity();
        $commonRarity->setHandle(Rarity::RARITY_COMMON);
        $commonRarity->setName('Pospolita');

        $uncommonRarity = new Rarity();
        $uncommonRarity->setHandle(Rarity::RARITY_UNCOMMON);
        $uncommonRarity->setName('Niepospolita');

        $rareRarity = new Rarity();
        $rareRarity->setHandle(Rarity::RARITY_RARE);
        $rareRarity->setName('Rzadka');

        $uniqueRarity = new Rarity();
        $uniqueRarity->setHandle(Rarity::RARITY_UNIQUE);
        $uniqueRarity->setName('Unikalna');

        $manager->persist($commonRarity);
        $manager->persist($uncommonRarity);
        $manager->persist($rareRarity);
        $manager->persist($uniqueRarity);

        $manager->flush();
    }
}
