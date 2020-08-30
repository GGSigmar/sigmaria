<?php

namespace App\Form\Core;

use App\Entity\Core\Attribute;
use App\Entity\Core\AttributeCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => AttributeCategory::class,
                'label' => 'Trait Category',
            ])
        ;
    }

    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Attribute::class,
            'has_handle' => true,
            'has_description' => true,
        ]);
    }
}