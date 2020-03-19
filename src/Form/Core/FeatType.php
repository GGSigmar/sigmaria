<?php

namespace App\Form\Core;

use App\Entity\Core\Actions;
use App\Entity\Core\Attribute;
use App\Entity\Core\Feat;
use App\Entity\Core\Rarity;
use App\Entity\Core\Source;
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
                'required' => false,
                'label' => 'Wymagania',
            ])
            ->add('frequency', TextareaType::class, [
                'required' => false,
                'label' => 'Częstotliwość',
            ])
            ->add('trigger', TextareaType::class, [
                'required' => false,
                'label' => 'Wyzwalacz',
            ])
            ->add('requirements', TextareaType::class, [
                'required' => false,
                'label' => 'Warunki',
            ])
            ->add('specialRules', TextareaType::class, [
                'required' => false,
                'label' => 'Właściwość specialna',
                'attr' => [
                    'rows' => 5,
                ]
            ])
            ->add('attributes', EntityType::class, [
                'label' => 'Atrybuty',
                'class' => Attribute::class,
                'multiple' => true,
                'group_by' => function (Attribute $attribute) {
                    return $attribute->getCategory()->getName();
                },
                'attr' => [
                    'size' => 20,
                ],
            ])
            ->add('source', EntityType::class, [
                'required' => false,
                'label' => 'Źródło',
                'class' => Source::class
            ])
            ->add('sourceStartingPageNumber', IntegerType::class, [
                'required' => false,
                'label' => 'Strona początkowa źródła',
            ])
            ->add('sourceEndingPageNumber', IntegerType::class, [
                'required' => false,
                'label' => 'Strona końcowa źródła',
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