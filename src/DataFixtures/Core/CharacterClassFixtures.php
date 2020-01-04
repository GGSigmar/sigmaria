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
        $alchemist->setName('Alchemik');

        $barbarian = new CharacterClass();
        $barbarian->setHandle(CharacterClass::CHARACTER_CLASS_BARBARIAN);
        $barbarian->setName('Barbarzyńca');

        $bard = new CharacterClass();
        $bard->setHandle(CharacterClass::CHARACTER_CLASS_BARD);
        $bard->setName('Bard');

        $champion = new CharacterClass();
        $champion->setHandle(CharacterClass::CHARACTER_CLASS_CHAMPION);
        $champion->setName('Czempion');

        $cleric = new CharacterClass();
        $cleric->setHandle(CharacterClass::CHARACTER_CLASS_CLERIC);
        $cleric->setName('Kleryk');

        $druid = new CharacterClass();
        $druid->setHandle(CharacterClass::CHARACTER_CLASS_DRUID);
        $druid->setName('Druid');

        $fighter = new CharacterClass();
        $fighter->setHandle(CharacterClass::CHARACTER_CLASS_FIGHTER);
        $fighter->setName('Wojownik');

        $monk = new CharacterClass();
        $monk->setHandle(CharacterClass::CHARACTER_CLASS_MONK);
        $monk->setName('Mnich');

        $ranger = new CharacterClass();
        $ranger->setHandle(CharacterClass::CHARACTER_CLASS_RANGER);
        $ranger->setName('Łowca');

        $rogue = new CharacterClass();
        $rogue->setHandle(CharacterClass::CHARACTER_CLASS_ROGUE);
        $rogue->setName('Łotr');

        $sorcerer = new CharacterClass();
        $sorcerer->setHandle(CharacterClass::CHARACTER_CLASS_SORCERER);
        $sorcerer->setName('Czarownik');

        $wizard = new CharacterClass();
        $wizard->setHandle(CharacterClass::CHARACTER_CLASS_WIZARD);
        $wizard->setName('Czarodziej');

        $investigator = new CharacterClass();
        $investigator->setHandle(CharacterClass::CHARACTER_CLASS_INVESTIGATOR);
        $investigator->setName('Śledczy');

        $oracle = new CharacterClass();
        $oracle->setHandle(CharacterClass::CHARACTER_CLASS_ORACLE);
        $oracle->setName('Wyrocznia');

        $swashbuckler = new CharacterClass();
        $swashbuckler->setHandle(CharacterClass::CHARACTER_CLASS_SWASHBUCKLER);
        $swashbuckler->setName('Zawadiaka');

        $witch = new CharacterClass();
        $witch->setHandle(CharacterClass::CHARACTER_CLASS_WITCH);
        $witch->setName('Wiedźma');

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