<?php

namespace App\Form\Ancestry;

use App\Entity\Ancestry\AncestralFeature;
use App\Entity\Ancestry\AncestralHitPoints;
use App\Entity\Ancestry\Ancestry;
use App\Entity\Core\Ability;
use App\Entity\Core\CoreTrait;
use App\Entity\Core\CoreTraitCategory;
use App\Entity\Core\MoveSpeed;
use App\Entity\Core\Size;
use App\Entity\Setting\Language;
use App\Form\Core\BaseEntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AncestryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hitPoints', EntityType::class, [
                'class' => AncestralHitPoints::class,
            ])
            ->add('size', EntityType::class, [
                'class' => Size::class,
            ])
            ->add('speed', EntityType::class, [
                'class' => MoveSpeed::class,
            ])
            ->add('languages', TextType::class, [

            ])
            ->add('abilityBoosts', EntityType::class, [
                'class' => Ability::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('abilityFlaws', EntityType::class, [
                'class' => Ability::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('languages', EntityType::class, [
                'class' => Language::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('traits', EntityType::class, [
                'class' => CoreTrait::class,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->innerJoin('t.category', 'c')
                        ->andWhere('c.handle LIKE :ancestral_category')
                        ->setParameter('ancestral_category', CoreTraitCategory::TRAIT_CATEGORY_ANCESTRAL);
                },
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