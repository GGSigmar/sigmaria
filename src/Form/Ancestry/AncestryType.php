<?php

namespace App\Form\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use App\Entity\Ancestry\AncestralHitPoints;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Core\Ability;
use App\Entity\Core\Attribute;
use App\Entity\Core\AttributeCategory;
use App\Entity\Core\Feat;
use App\Entity\Core\MoveSpeed;
use App\Entity\Core\Rarity;
use App\Entity\Core\Size;
use App\Entity\Setting\Culture;
use App\Form\Core\BaseEntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AncestryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sortOrder', IntegerType::class, [
                'label' => 'Kolejność sortowania'
            ])
            ->add('rarity', EntityType::class, [
                'label' => 'Rzadkość',
                'class' => Rarity::class,
                'attr' => [
                    'class' => 'js-example-basic-single',
                ]
            ])
            ->add('hitPoints', EntityType::class, [
                'class' => AncestralHitPoints::class,
                'label' => 'Punkty zdrowia',
                'attr' => [
                    'class' => 'js-example-basic-single',
                ]
            ])
            ->add('size', EntityType::class, [
                'class' => Size::class,
                'label' => 'Rozmiar',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->andWhere('s.isPlayerCharacterSize = true');
                },
                'attr' => [
                    'class' => 'js-example-basic-single',
                ]
            ])
            ->add('speed', EntityType::class, [
                'class' => MoveSpeed::class,
                'label' => 'Prędkość ruchu',
                'attr' => [
                    'class' => 'js-example-basic-single',
                ]
            ])
            ->add('abilityBoosts', EntityType::class, [
                'class' => Ability::class,
                'label' => 'Premie do cech',
                'required' => false,
                'multiple' => true,
                'attr' => [
                    'class' => 'js-example-basic-single',
                ]
            ])
            ->add('attributes', EntityType::class, [
                'class' => Attribute::class,
                'label' => 'Atrybuty',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->innerJoin('a.category', 'c')
                        ->andWhere('c.handle LIKE :ancestral_category')
                        ->setParameter('ancestral_category', AttributeCategory::ATTRIBUTE_CATEGORY_ANCESTRAL);
                },
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ]
            ])
            ->add('cultures', EntityType::class, [
                'required' => false,
                'class' => Culture::class,
                'label' => 'Kultury',
                'multiple' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ]
            ])
            ->add('ancestralFeatures', EntityType::class, [
                'class' => AncestralFeature::class,
                'label' => 'Zdolności rasowe',
                'required' => false,
                'multiple' => true,
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ]
            ])
            ->add('feats', EntityType::class, [
                'class' => Feat::class,
                'label' => 'Rasowe atuty',
                'required' => false,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->innerJoin('f.attributes', 'a')
                        ->innerJoin('a.category', 'c')
                        ->andWhere('c.handle LIKE :ancestral_category')
                        ->setParameter('ancestral_category', AttributeCategory::ATTRIBUTE_CATEGORY_ANCESTRAL);
                },
                'attr' => [
                    'class' => 'js-example-basic-multiple'
                ],
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
            'data_class' => Ancestry::class,
        ]);
    }
}