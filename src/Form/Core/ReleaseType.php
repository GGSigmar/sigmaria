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
            ->add('name', TextType::class)
            ->add('contentVersion', TextType::class)
            ->add('contentChangesNote', CKEditorType::class, [
                'required' => false,
                'config' => BaseEntityType::DEFAULT_CKEDITOR_CONFIG,
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