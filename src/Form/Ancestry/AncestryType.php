<?php

namespace App\Form\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use App\Entity\Ancestry\AncestralHitPoints;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Core\Ability;
use App\Entity\Core\Attribute;
use App\Entity\Core\AttributeCategory;
use App\Entity\Core\MoveSpeed;
use App\Entity\Core\Size;
use App\Entity\Setting\Culture;
use App\Form\Core\BaseEntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AncestryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hitPoints', EntityType::class, [
                'class' => AncestralHitPoints::class,
                'label' => 'Punkty zdrowia',
            ])
            ->add('size', EntityType::class, [
                'class' => Size::class,
                'label' => 'Rozmiar',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->andWhere('s.isPlayerCharacterSize = true');
                },
            ])
            ->add('speed', EntityType::class, [
                'class' => MoveSpeed::class,
                'label' => 'Prędkość ruchu',
            ])
            ->add('abilityBoosts', EntityType::class, [
                'class' => Ability::class,
                'label' => 'Premie do cech',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('attributes', EntityType::class, [
                'class' => Attribute::class,
                'label' => 'Atrybuty',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->innerJoin('t.category', 'c')
                        ->andWhere('c.handle LIKE :ancestral_category')
                        ->setParameter('ancestral_category', AttributeCategory::TRAIT_CATEGORY_ANCESTRAL);
                },
            ])
            ->add('cultures', EntityType::class, [
                'class' => Culture::class,
                'label' => 'Kultury',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('ancestralFeatures', EntityType::class, [
                'class' => AncestralFeature::class,
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
            'data_class' => Ancestry::class,
        ]);
    }
}