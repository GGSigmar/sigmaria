<?php

namespace App\DataFixtures\Setting;

use App\DataFixtures\Core\RarityFixtures;
use App\Entity\Setting\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $commonLanguage = new Language();
        $commonLanguage->setHandle(Language::LANGUAGE_COMMON);
        $commonLanguage->setName('Wspólny');

        $elvishLanguage = new Language();
        $elvishLanguage->setHandle(Language::LANGUAGE_ELVISH);
        $elvishLanguage->setName('Elficki');

        $dwarvishLanguage = new Language();
        $dwarvishLanguage->setHandle(Language::LANGUAGE_DWARVISH);
        $dwarvishLanguage->setName('Krasnoludzki');

        $manager->persist($commonLanguage);
        $manager->persist($elvishLanguage);
        $manager->persist($dwarvishLanguage);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            RarityFixtures::class,
        );
    }
}
