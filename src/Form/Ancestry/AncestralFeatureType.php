<?php

namespace App\Form\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AncestralFeatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('handle', TextType::class, [

            ])
            ->add('name', TextType::class, [

            ])
            ->add('description', TextareaType::class, [

            ])
            ->add('value', IntegerType::class, [

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AncestralFeature::class,
        ]);
    }
}