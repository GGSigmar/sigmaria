<?php

namespace App\Form\Core;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
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
            ->add('description', CKEditorType::class, [
                'label' => 'Opis',
                'required' => false,
            ])
        ;
    }
}