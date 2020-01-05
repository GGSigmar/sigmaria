<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\AttributeCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AttributeCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $genericAttributeCategory = new AttributeCategory();
        $genericAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_GENERIC);
        $genericAttributeCategory->setName('Atrybuty ogólne');

        $ancestralAttributeCategory = new AttributeCategory();
        $ancestralAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_ANCESTRAL);
        $ancestralAttributeCategory->setName('Atrybuty rasowe');

        $classAttributeCategory = new AttributeCategory();
        $classAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_CLASS);
        $classAttributeCategory->setName('Atrybuty klasowe');

        $cultureAttributeCategory = new AttributeCategory();
        $cultureAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_CULTURE);
        $cultureAttributeCategory->setName('Atrybuty kulturowe');

        $manager->persist($genericAttributeCategory);
        $manager->persist($ancestralAttributeCategory);
        $manager->persist($classAttributeCategory);
        $manager->persist($cultureAttributeCategory);

        $manager->flush();
    }
}
