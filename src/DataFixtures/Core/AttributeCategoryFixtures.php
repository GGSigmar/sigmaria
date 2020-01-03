<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\AttributeCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AttributeCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ancestralTraitCategory = new AttributeCategory();
        $ancestralTraitCategory->setHandle(AttributeCategory::TRAIT_CATEGORY_ANCESTRAL);
        $ancestralTraitCategory->setName('Atrybuty rasowe');

        $classTraitCategory = new AttributeCategory();
        $classTraitCategory->setHandle(AttributeCategory::TRAIT_CATEGORY_CLASS);
        $classTraitCategory->setName('Atrybuty klasowe');

        $manager->persist($ancestralTraitCategory);
        $manager->persist($classTraitCategory);

        $manager->flush();
    }
}
