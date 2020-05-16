<?php

namespace App\Form\Setting;

use App\Entity\Setting\Script;
use App\Form\Core\BaseEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScriptType extends AbstractType
{
    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Script::class,
            'has_description' => true,
        ]);
    }
}