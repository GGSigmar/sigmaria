<?php

namespace App\Form\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use App\Entity\Ancestry\Ancestry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AncestryType extends AbstractType
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
            ->add('abilityScoreIncrease', TextType::class, [

            ])
            ->add('age', TextType::class, [

            ])
            ->add('alignment', TextType::class, [

            ])
            ->add('size', TextType::class, [

            ])
            ->add('speed', TextType::class, [

            ])
            ->add('languages', TextType::class, [

            ])
            ->add('ancestralFeatures', EntityType::class, [
                'class' => AncestralFeature::class,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ancestry::class,
        ]);
    }
}