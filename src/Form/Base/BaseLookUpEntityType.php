<?php

namespace App\Form\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BaseLookUpEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('handle', TextType::class, [

            ])
            ->add('name', TextType::class, [

            ])
            ->add('description', TextType::class, [

            ])
            ->add('save', SubmitType::class, [

            ])
        ;
    }
}