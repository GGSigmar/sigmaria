<?php

namespace App\DataFixtures\Core;

use App\Entity\Core\AttributeCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AttributeCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ancestralAttributeCategory = new AttributeCategory();
        $ancestralAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_ANCESTRAL);
        $ancestralAttributeCategory->setName('Atrybuty rasowe');

        $classAttributeCategory = new AttributeCategory();
        $classAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_CLASS);
        $classAttributeCategory->setName('Atrybuty klasowe');

        $manager->persist($ancestralAttributeCategory);
        $manager->persist($classAttributeCategory);

        $manager->flush();
    }
}
