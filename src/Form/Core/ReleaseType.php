<?php

namespace App\Form\Core;

use App\Entity\Core\Release;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReleaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa wydania',
            ])
            ->add('contentVersion', TextType::class, [
                'label' => 'Wersja zawartości',
            ])
            ->add('contentChanges', CKEditorType::class, [
                'label' => 'Zmiany zawartości',
                'required' => false,
                'config' => array(
                    'toolbar' => 'custom_toolbar',
                    'language' => 'pl',
                    'entities_latin' => false,
                    'height' => 300,
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Release::class,
        ]);
    }
}