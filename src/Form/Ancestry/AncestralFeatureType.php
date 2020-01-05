<?php

namespace App\Form\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use App\Form\Core\BaseValuedEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AncestralFeatureType extends AbstractType
{
    public function getParent()
    {
        return BaseValuedEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AncestralFeature::class,
        ]);
    }
}