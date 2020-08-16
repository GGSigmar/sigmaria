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
        $genericAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_GENERAL);
        $genericAttributeCategory->setName('General Traits');

        $ancestralAttributeCategory = new AttributeCategory();
        $ancestralAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_ANCESTRAL);
        $ancestralAttributeCategory->setName('Ancestral Traits');

        $classAttributeCategory = new AttributeCategory();
        $classAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_CLASS);
        $classAttributeCategory->setName('Class Traits');

        $culturalAttributeCategory = new AttributeCategory();
        $culturalAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_CULTURAL);
        $culturalAttributeCategory->setName('Cultural Traits');

        $heritageAttributeCategory = new AttributeCategory();
        $heritageAttributeCategory->setHandle(AttributeCategory::ATTRIBUTE_CATEGORY_CULTURAL);
        $heritageAttributeCategory->setName('Heritage Traits');

        $manager->persist($genericAttributeCategory);
        $manager->persist($ancestralAttributeCategory);
        $manager->persist($classAttributeCategory);
        $manager->persist($culturalAttributeCategory);
        $manager->persist($heritageAttributeCategory);

        $manager->flush();
    }
}
