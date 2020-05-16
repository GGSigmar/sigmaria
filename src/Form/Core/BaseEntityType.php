<?php

namespace App\Form\Core;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseEntityType extends AbstractType
{
    public const DEFAULT_CKEDITOR_CONFIG = [
        'toolbar' => 'custom_toolbar',
        'language' => 'pl',
        'entities_latin' => false,
        'height' => 300,
        'enterMode' => 'CKEDITOR.ENTER_BR',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa',
            ]);

        if ($options['has_handle']) {
            $builder
                ->add('handle', TextType::class, [
                    'label' => 'Identyfikator',

                ]);
        }

        if ($options['has_description']) {
            $builder
                ->add('description', CKEditorType::class, [
                    'label' => 'Opis',
                    'required' => false,
                    'config' => self::DEFAULT_CKEDITOR_CONFIG
                ]);
        }

        if ($options['has_value']) {
            $builder
                ->add('value', IntegerType::class, [
                    'label' => 'Wartość',
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'has_handle' => false,
            'has_description' => false,
            'has_value' => false,
        ]);
    }
}