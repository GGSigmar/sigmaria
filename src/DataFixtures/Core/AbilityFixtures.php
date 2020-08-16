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
        $strengthAbility->setName('Strength');
        $strengthAbility->setSortOrder(1);
        $strengthAbility->setAbbreviation(Ability::ABILITY_STRENGTH_ABBREVIATION);
        $this->addReference(Ability::ABILITY_STRENGTH, $strengthAbility);

        $dexterityAbility = new Ability();
        $dexterityAbility->setHandle(Ability::ABILITY_DEXTERITY);
        $dexterityAbility->setName('Dexterity');
        $dexterityAbility->setSortOrder(2);
        $dexterityAbility->setAbbreviation(Ability::ABILITY_DEXTERITY_ABBREVIATION);
        $this->addReference(Ability::ABILITY_DEXTERITY, $dexterityAbility);

        $constitutionAbility = new Ability();
        $constitutionAbility->setHandle(Ability::ABILITY_CONSTITUTION);
        $constitutionAbility->setName('Constitution');
        $constitutionAbility->setSortOrder(3);
        $constitutionAbility->setAbbreviation(Ability::ABILITY_CONSTITUTION_ABBREVIATION);
        /* Żaden Skill nie używa Kondycji - nie potrzeba referencji */

        $intelligenceAbility = new Ability();
        $intelligenceAbility->setHandle(Ability::ABILITY_INTELLIGENCE);
        $intelligenceAbility->setName('Intelligence');
        $intelligenceAbility->setSortOrder(4);
        $intelligenceAbility->setAbbreviation(Ability::ABILITY_INTELLIGENCE_ABBREVIATION);
        $this->addReference(Ability::ABILITY_INTELLIGENCE, $intelligenceAbility);

        $wisdomAbility = new Ability();
        $wisdomAbility->setHandle(Ability::ABILITY_WISDOM);
        $wisdomAbility->setName('Wisdom');
        $wisdomAbility->setSortOrder(5);
        $wisdomAbility->setAbbreviation(Ability::ABILITY_WISDOM_ABBREVIATION);
        $this->addReference(Ability::ABILITY_WISDOM, $wisdomAbility);

        $charismaAbility = new Ability();
        $charismaAbility->setHandle(Ability::ABILITY_CHARISMA);
        $charismaAbility->setName('Charisma');
        $charismaAbility->setSortOrder(6);
        $charismaAbility->setAbbreviation(Ability::ABILITY_CHARISMA_ABBREVIATION);
        $this->addReference(Ability::ABILITY_CHARISMA, $charismaAbility);

        $manager->persist($strengthAbility);
        $manager->persist($dexterityAbility);
        $manager->persist($constitutionAbility);
        $manager->persist($intelligenceAbility);
        $manager->persist($wisdomAbility);
        $manager->persist($charismaAbility);

        $manager->flush();
    }
}
