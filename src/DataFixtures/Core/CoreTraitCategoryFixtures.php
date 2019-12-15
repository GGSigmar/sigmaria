<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\CoreTraitCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CoreTraitCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ancestralTraitCategory = new CoreTraitCategory();
        $ancestralTraitCategory->setHandle(CoreTraitCategory::TRAIT_CATEGORY_ANCESTRAL);
        $ancestralTraitCategory->setName('Atrybuty rasowe');

        $classTraitCategory = new CoreTraitCategory();
        $classTraitCategory->setHandle(CoreTraitCategory::TRAIT_CATEGORY_CLASS);
        $classTraitCategory->setName('Atrybuty klasowe');

        $manager->persist($ancestralTraitCategory);
        $manager->persist($classTraitCategory);

        $manager->flush();
    }
}
