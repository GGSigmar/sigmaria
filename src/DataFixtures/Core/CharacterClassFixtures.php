<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\CharacterClass;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CharacterClassFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $alchemist = new CharacterClass();
        $alchemist->setHandle(CharacterClass::CHARACTER_CLASS_ALCHEMIST);
        $alchemist->setName('Alchemist');

        $barbarian = new CharacterClass();
        $barbarian->setHandle(CharacterClass::CHARACTER_CLASS_BARBARIAN);
        $barbarian->setName('Barbarian');

        $bard = new CharacterClass();
        $bard->setHandle(CharacterClass::CHARACTER_CLASS_BARD);
        $bard->setName('Bard');

        $champion = new CharacterClass();
        $champion->setHandle(CharacterClass::CHARACTER_CLASS_CHAMPION);
        $champion->setName('Champion');

        $cleric = new CharacterClass();
        $cleric->setHandle(CharacterClass::CHARACTER_CLASS_CLERIC);
        $cleric->setName('Cleric');

        $druid = new CharacterClass();
        $druid->setHandle(CharacterClass::CHARACTER_CLASS_DRUID);
        $druid->setName('Druid');

        $fighter = new CharacterClass();
        $fighter->setHandle(CharacterClass::CHARACTER_CLASS_FIGHTER);
        $fighter->setName('Fighter');

        $monk = new CharacterClass();
        $monk->setHandle(CharacterClass::CHARACTER_CLASS_MONK);
        $monk->setName('Monk');

        $ranger = new CharacterClass();
        $ranger->setHandle(CharacterClass::CHARACTER_CLASS_RANGER);
        $ranger->setName('Ranger');

        $rogue = new CharacterClass();
        $rogue->setHandle(CharacterClass::CHARACTER_CLASS_ROGUE);
        $rogue->setName('Rogue');

        $sorcerer = new CharacterClass();
        $sorcerer->setHandle(CharacterClass::CHARACTER_CLASS_SORCERER);
        $sorcerer->setName('Sorcerer');

        $wizard = new CharacterClass();
        $wizard->setHandle(CharacterClass::CHARACTER_CLASS_WIZARD);
        $wizard->setName('Wizard');

        $investigator = new CharacterClass();
        $investigator->setHandle(CharacterClass::CHARACTER_CLASS_INVESTIGATOR);
        $investigator->setName('Investigator');

        $oracle = new CharacterClass();
        $oracle->setHandle(CharacterClass::CHARACTER_CLASS_ORACLE);
        $oracle->setName('Oracle');

        $swashbuckler = new CharacterClass();
        $swashbuckler->setHandle(CharacterClass::CHARACTER_CLASS_SWASHBUCKLER);
        $swashbuckler->setName('Swashbuckler');

        $witch = new CharacterClass();
        $witch->setHandle(CharacterClass::CHARACTER_CLASS_WITCH);
        $witch->setName('Witch');

        $manager->persist($alchemist);
        $manager->persist($barbarian);
        $manager->persist($bard);
        $manager->persist($champion);
        $manager->persist($cleric);
        $manager->persist($druid);
        $manager->persist($fighter);
        $manager->persist($monk);
        $manager->persist($ranger);
        $manager->persist($rogue);
        $manager->persist($sorcerer);
        $manager->persist($wizard);
        $manager->persist($investigator);
        $manager->persist($oracle);
        $manager->persist($swashbuckler);
        $manager->persist($witch);

        $manager->flush();
    }
}