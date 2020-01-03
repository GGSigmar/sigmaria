<?php

namespace App\Form\Core;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BaseEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('handle', TextType::class, [
                'label' => 'Identyfikator',

            ])
            ->add('name', TextType::class, [
                'label' => 'Nazwa',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis',
                'required' => false,
            ])
        ;
    }
}