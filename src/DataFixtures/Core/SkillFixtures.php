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
        $acrobatics->setName('Akrobatyka');
        $acrobatics->setAbility($this->getReference(Ability::ABILITY_DEXTERITY));

        $arcana = new Skill();
        $arcana->setHandle(Skill::SKILL_ARCANA);
        $arcana->setName('Arkana');
        $arcana->setAbility($this->getReference(Ability::ABILITY_INTELLIGENCE));

        $athletics = new Skill();
        $athletics->setHandle(Skill::SKILL_ATHLETICS);
        $athletics->setName('Atletyka');
        $athletics->setAbility($this->getReference(Ability::ABILITY_STRENGTH));

        $crafting = new Skill();
        $crafting->setHandle(Skill::SKILL_CRAFTING);
        $crafting->setName('Rzemiosło');
        $crafting->setAbility($this->getReference(Ability::ABILITY_INTELLIGENCE));

        $deception = new Skill();
        $deception->setHandle(Skill::SKILL_DECEPTION);
        $deception->setName('Oszustwo');
        $deception->setAbility($this->getReference(Ability::ABILITY_CHARISMA));

        $diplomacy = new Skill();
        $diplomacy->setHandle(Skill::SKILL_DIPLOMACY);
        $diplomacy->setName('Dyplomacja');
        $diplomacy->setAbility($this->getReference(Ability::ABILITY_CHARISMA));

        $intimidation = new Skill();
        $intimidation->setHandle(Skill::SKILL_INTIMIDATION);
        $intimidation->setName('Zastraszanie');
        $intimidation->setAbility($this->getReference(Ability::ABILITY_CHARISMA));

        $medicine = new Skill();
        $medicine->setHandle(Skill::SKILL_MEDICINE);
        $medicine->setName('Medycyna');
        $medicine->setAbility($this->getReference(Ability::ABILITY_WISDOM));

        $nature = new Skill();
        $nature->setHandle(Skill::SKILL_NATURE);
        $nature->setName('Natura');
        $nature->setAbility($this->getReference(Ability::ABILITY_WISDOM));

        $occultism = new Skill();
        $occultism->setHandle(Skill::SKILL_OCCULTISM);
        $occultism->setName('Okultyzm');
        $occultism->setAbility($this->getReference(Ability::ABILITY_INTELLIGENCE));

        $performance = new Skill();
        $performance->setHandle(Skill::SKILL_PERFORMANCE);
        $performance->setName('Występy');
        $performance->setAbility($this->getReference(Ability::ABILITY_CHARISMA));

        $religion = new Skill();
        $religion->setHandle(Skill::SKILL_RELIGION);
        $religion->setName('Religia');
        $religion->setAbility($this->getReference(Ability::ABILITY_WISDOM));

        $society = new Skill();
        $society->setHandle(Skill::SKILL_SOCIETY);
        $society->setName('Społeczeństwo');
        $society->setAbility($this->getReference(Ability::ABILITY_INTELLIGENCE));

        $stealth = new Skill();
        $stealth->setHandle(Skill::SKILL_STEALTH);
        $stealth->setName('Ukrywanie się');
        $stealth->setAbility($this->getReference(Ability::ABILITY_DEXTERITY));

        $survival = new Skill();
        $survival->setHandle(Skill::SKILL_SURVIVAL);
        $survival->setName('Przetrwanie');
        $survival->setAbility($this->getReference(Ability::ABILITY_WISDOM));

        $thievery = new Skill();
        $thievery->setHandle(Skill::SKILL_THIEVERY);
        $thievery->setName('Złodziejstwo');
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
