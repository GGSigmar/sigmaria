<?php

namespace App\Form\Core;

use App\Entity\Core\Actions;
use App\Entity\Core\CoreTrait;
use App\Entity\Core\Feat;
use App\Entity\Core\Rarity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeatType extends AbstractType
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
            ->add('rarity', EntityType::class, [
                'class' => Rarity::class
            ])
            ->add('actions', EntityType::class, [
                'class' => Actions::class,
            ])
            ->add('level', IntegerType::class, [

            ])
            ->add('prerequisites', TextareaType::class, [

            ])
            ->add('frequency', TextareaType::class, [

            ])
            ->add('trigger', TextareaType::class, [

            ])
            ->add('requirements', TextareaType::class, [

            ])
            ->add('specialRules', TextareaType::class, [

            ])
            ->add('traits', EntityType::class, [
                'class' => CoreTrait::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Feat::class,
        ]);
    }
}