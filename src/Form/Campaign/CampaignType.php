<?php

namespace App\Form\Campaign;

use App\Entity\Campaign\Campaign;
use App\Form\Core\BaseEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
            'is_name_required' => true,
            'has_handle' => false,
            'has_description' => false,
            'has_value' => false,
            'has_sort_order' => false,
        ]);
    }
}