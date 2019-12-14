<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\Ability;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AbilityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $strengthAbility = new Ability();
        $strengthAbility->setHandle(Ability::ABILITY_STRENGTH);
        $strengthAbility->setName('Siła');

        $dexterityAbility = new Ability();
        $dexterityAbility->setHandle(Ability::ABILITY_DEXTERITY);
        $dexterityAbility->setName('Zręczność');

        $constitutionAbility = new Ability();
        $constitutionAbility->setHandle(Ability::ABILITY_CONSTITUTION);
        $constitutionAbility->setName('Kondycja');

        $intelligenceAbility = new Ability();
        $intelligenceAbility->setHandle(Ability::ABILITY_INTELLIGENCE);
        $intelligenceAbility->setName('Inteligencja');

        $wisdomAbility = new Ability();
        $wisdomAbility->setHandle(Ability::ABILITY_WISDOM);
        $wisdomAbility->setName('Mądrość');

        $charismaAbility = new Ability();
        $charismaAbility->setHandle(Ability::ABILITY_CHARISMA);
        $charismaAbility->setName('Charyzma');

        $manager->persist($strengthAbility);
        $manager->persist($dexterityAbility);
        $manager->persist($constitutionAbility);
        $manager->persist($intelligenceAbility);
        $manager->persist($wisdomAbility);
        $manager->persist($charismaAbility);

        $manager->flush();
    }
}
