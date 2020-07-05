<?php

namespace App\Form\Core;

use App\Entity\Core\Paragraph;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParagraphType extends AbstractType
{
    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paragraph::class,
            'has_sort_order' => true,
            'has_description' => true,
            'is_name_required' => false,
        ]);
    }
}