<?php

namespace App\Form\Core;

use App\Entity\Core\AttributeCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributeCategoryType extends AbstractType
{
    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => AttributeCategory::class,
            'has_handle' => true,
        ]);
    }
}