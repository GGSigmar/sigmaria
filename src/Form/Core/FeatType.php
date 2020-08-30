<?php

namespace App\Form\Core;

use App\Entity\Core\Actions;
use App\Entity\Core\Attribute;
use App\Entity\Core\Feat;
use App\Entity\Core\Rarity;
use App\Entity\Core\Source;
use App\Form\Core\Embedded\EntitySourceType;
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
                'class' => Rarity::class
            ])
            ->add('actions', EntityType::class, [
                'required' => false,
                'class' => Actions::class,
                'placeholder' => 'Nie dotyczy',
            ])
            ->add('level', IntegerType::class, [
            ])
            ->add('prerequisites', TextareaType::class, [
                'required' => false,
            ])
            ->add('frequency', TextareaType::class, [
                'required' => false,
            ])
            ->add('trigger', TextareaType::class, [
                'required' => false,
            ])
            ->add('requirements', TextareaType::class, [
                'required' => false,
            ])
            ->add('specialRules', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => 5,
                ]
            ])
            ->add('attributes', EntityType::class, [
                'label' => 'Traits',
                'class' => Attribute::class,
                'multiple' => true,
                'group_by' => function (Attribute $attribute) {
                    return $attribute->getCategory()->getName();
                },
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ]
            ])
            ->add('source', EntitySourceType::class, [
                'label' => 'Copyright',
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
            'has_description' => true,
        ]);
    }
}