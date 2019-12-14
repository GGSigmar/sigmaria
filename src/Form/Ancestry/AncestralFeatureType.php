<?php

namespace App\Form\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use App\Form\Core\BaseValuedEntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AncestralFeatureType extends BaseValuedEntityType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AncestralFeature::class,
        ]);
    }
}