<?php

namespace App\Form\Core;

use App\Entity\Core\Actions;
use App\Entity\Core\Attribute;
use App\Entity\Core\Feat;
use App\Entity\Core\Rarity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rarity', EntityType::class, [
                'label' => 'Rzadkość',
                'class' => Rarity::class
            ])
            ->add('actions', EntityType::class, [
                'required' => false,
                'label' => 'Akcje',
                'class' => Actions::class,
                'placeholder' => 'Nie dotyczy',
            ])
            ->add('level', IntegerType::class, [
                'label' => 'Poziom',
            ])
            ->add('prerequisites', TextareaType::class, [
                'label' => 'Wymagania',
            ])
            ->add('frequency', TextareaType::class, [
                'label' => 'Częstotliwość',
            ])
            ->add('trigger', TextareaType::class, [
                'label' => 'Wyzwalacz',
            ])
            ->add('requirements', TextareaType::class, [
                'label' => 'Warunki',
            ])
            ->add('specialRules', TextareaType::class, [
                'label' => 'Wyjątki/właściwość specjalna/specjalne zasady',
            ])
            ->add('attributes', EntityType::class, [
                'label' => 'Atrybuty',
                'class' => Attribute::class,
                'multiple' => true,
                'expanded' => true,
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
            'data_class' => Feat::class,
        ]);
    }
}