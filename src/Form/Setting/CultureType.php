<?php

namespace App\Form\Setting;

use App\Entity\Ancestry\Ancestry;
use App\Entity\Core\AttributeCategory;
use App\Entity\Core\CharacterClass;
use App\Entity\Core\Feat;
use App\Entity\Setting\Background;
use App\Entity\Setting\Culture;
use App\Entity\Setting\Language;
use App\Form\Core\BaseEntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CultureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commonAncestries', EntityType::class, [
                'class' => Ancestry::class,
                'label' => 'Pospolite rasy',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('commonClasses', EntityType::class, [
                'class' => CharacterClass::class,
                'label' => 'Pospolite klasy',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('commonBackgrounds', EntityType::class, [
                'class' => Background::class,
                'label' => 'Pospolite pochodzenia',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('commonLanguages', EntityType::class, [
                'class' => Language::class,
                'label' => 'Pospolite języki',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('feats', EntityType::class, [
                'class' => Feat::class,
                'label' => 'Kulturowe atuty',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->innerJoin('f.attributes', 'a')
                        ->innerJoin('a.category', 'c')
                        ->andWhere('c.handle LIKE :cultural_category')
                        ->setParameter('cultural_category', AttributeCategory::ATTRIBUTE_CATEGORY_ANCESTRAL);
                },
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
            'data_class' => Culture::class,
            'has_description' => true,
        ]);
    }
}