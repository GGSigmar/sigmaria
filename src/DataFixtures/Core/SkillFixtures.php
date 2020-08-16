<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\Ability;
use App\Entity\Core\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SkillFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $acrobatics = new Skill();
        $acrobatics->setHandle(Skill::SKILL_ACROBATICS);
        $acrobatics->setName('Acrobatics');
        $acrobatics->setAbility($this->getReference(Ability::ABILITY_DEXTERITY));

        $arcana = new Skill();
        $arcana->setHandle(Skill::SKILL_ARCANA);
        $arcana->setName('Arcana');
        $arcana->setAbility($this->getReference(Ability::ABILITY_INTELLIGENCE));

        $athletics = new Skill();
        $athletics->setHandle(Skill::SKILL_ATHLETICS);
        $athletics->setName('Athletics');
        $athletics->setAbility($this->getReference(Ability::ABILITY_STRENGTH));

        $crafting = new Skill();
        $crafting->setHandle(Skill::SKILL_CRAFTING);
        $crafting->setName('Crafting');
        $crafting->setAbility($this->getReference(Ability::ABILITY_INTELLIGENCE));

        $deception = new Skill();
        $deception->setHandle(Skill::SKILL_DECEPTION);
        $deception->setName('Deception');
        $deception->setAbility($this->getReference(Ability::ABILITY_CHARISMA));

        $diplomacy = new Skill();
        $diplomacy->setHandle(Skill::SKILL_DIPLOMACY);
        $diplomacy->setName('Diplomacy');
        $diplomacy->setAbility($this->getReference(Ability::ABILITY_CHARISMA));

        $intimidation = new Skill();
        $intimidation->setHandle(Skill::SKILL_INTIMIDATION);
        $intimidation->setName('Intimidation');
        $intimidation->setAbility($this->getReference(Ability::ABILITY_CHARISMA));

        $medicine = new Skill();
        $medicine->setHandle(Skill::SKILL_MEDICINE);
        $medicine->setName('Medicine');
        $medicine->setAbility($this->getReference(Ability::ABILITY_WISDOM));

        $nature = new Skill();
        $nature->setHandle(Skill::SKILL_NATURE);
        $nature->setName('Nature');
        $nature->setAbility($this->getReference(Ability::ABILITY_WISDOM));

        $occultism = new Skill();
        $occultism->setHandle(Skill::SKILL_OCCULTISM);
        $occultism->setName('Occultism');
        $occultism->setAbility($this->getReference(Ability::ABILITY_INTELLIGENCE));

        $performance = new Skill();
        $performance->setHandle(Skill::SKILL_PERFORMANCE);
        $performance->setName('Performance');
        $performance->setAbility($this->getReference(Ability::ABILITY_CHARISMA));

        $religion = new Skill();
        $religion->setHandle(Skill::SKILL_RELIGION);
        $religion->setName('Religion');
        $religion->setAbility($this->getReference(Ability::ABILITY_WISDOM));

        $society = new Skill();
        $society->setHandle(Skill::SKILL_SOCIETY);
        $society->setName('Society');
        $society->setAbility($this->getReference(Ability::ABILITY_INTELLIGENCE));

        $stealth = new Skill();
        $stealth->setHandle(Skill::SKILL_STEALTH);
        $stealth->setName('Stealth');
        $stealth->setAbility($this->getReference(Ability::ABILITY_DEXTERITY));

        $survival = new Skill();
        $survival->setHandle(Skill::SKILL_SURVIVAL);
        $survival->setName('Survival');
        $survival->setAbility($this->getReference(Ability::ABILITY_WISDOM));

        $thievery = new Skill();
        $thievery->setHandle(Skill::SKILL_THIEVERY);
        $thievery->setName('Thievery');
        $thievery->setAbility($this->getReference(Ability::ABILITY_DEXTERITY));

        $manager->persist($acrobatics);
        $manager->persist($arcana);
        $manager->persist($athletics);
        $manager->persist($crafting);
        $manager->persist($deception);
        $manager->persist($diplomacy);
        $manager->persist($intimidation);
        $manager->persist($medicine);
        $manager->persist($nature);
        $manager->persist($occultism);
        $manager->persist($performance);
        $manager->persist($religion);
        $manager->persist($society);
        $manager->persist($stealth);
        $manager->persist($survival);
        $manager->persist($thievery);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AbilityFixtures::class,
        );
    }
}
