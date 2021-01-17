<?php

namespace App\Form\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use App\Entity\Ancestry\AncestralHitPoints;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Ancestry\Heritage;
use App\Entity\Core\Ability;
use App\Entity\Core\Attribute;
use App\Entity\Core\AttributeCategory;
use App\Entity\Core\Feat;
use App\Entity\Core\MoveSpeed;
use App\Entity\Core\Rarity;
use App\Entity\Core\Size;
use App\Form\Core\BaseEntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeritageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valueAdjustment', IntegerType::class, [
                'required' => false,
            ])
            ->add('rarity', EntityType::class, [
                'class' => Rarity::class
            ])
            ->add('ancestry', EntityType::class, [
                'class' => Ancestry::class,
            ])
            ->add('hitPoints', EntityType::class, [
                'class' => AncestralHitPoints::class,
                'required' => false,
                'placeholder' => 'Wybierz',
            ])
            ->add('size', EntityType::class, [
                'class' => Size::class,
                'required' => false,
                'placeholder' => 'Wybierz',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->andWhere('s.isPlayerCharacterSize = true');
                },
            ])
            ->add('speed', EntityType::class, [
                'class' => MoveSpeed::class,
                'required' => false,
                'placeholder' => 'Wybierz',
            ])
            ->add('abilityBoosts', EntityType::class, [
                'class' => Ability::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('attributes', EntityType::class, [
                'class' => Attribute::class,
                'multiple' => true,
                'group_by' => function (Attribute $attribute) {
                    return $attribute->getCategory()->getName();
                },
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ]
            ])
            ->add('ancestralFeatures', EntityType::class, [
                'class' => AncestralFeature::class,
                'multiple' => true,
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ]
            ])
            ->add('feats', EntityType::class, [
                'class' => Feat::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->innerJoin('f.attributes', 'a')
                        ->innerJoin('a.category', 'c')
                        ->andWhere('c.handle IN (:categories)')
                        ->andWhere('f.isEdit = :false')
                        ->setParameter('false', false)
                        ->setParameter(
                            'categories',
                            [
                                AttributeCategory::ATTRIBUTE_CATEGORY_HERITAGE,
                                AttributeCategory::ATTRIBUTE_CATEGORY_ANCESTRAL,
                            ]
                        );
                },
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ]
            ]);
    }

    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Heritage::class,
            'has_handle' => true,
            'has_description' => true,
        ]);
    }
}