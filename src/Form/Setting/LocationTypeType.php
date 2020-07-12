<?php

namespace App\Form\Setting;

use App\Entity\Setting\LocationType as LocationType;
use App\Form\Core\BaseEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationTypeType extends AbstractType
{
    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LocationType::class,
            'has_handle' => true,
        ]);
    }
}