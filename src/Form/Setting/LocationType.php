<?php

namespace App\Form\Setting;

use App\Entity\Core\Attribute;
use App\Entity\Setting\Location;
use App\Form\Core\BaseEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => \App\Entity\Setting\LocationType::class,
                'label' => 'Typ lokacji',
            ])
            ->add('parentLocation', EntityType::class, [
                'class' => Location::class,
                'label' => 'Lokacja nadrzędna',
                'required' => false,
                'placeholder' => 'Wybierz',
            ])
            ->add('childrenLocations', EntityType::class, [
                'class' => Location::class,
                'label' => 'Lokacje podrzędne',
                'multiple' => true,
                'group_by' => function (Location $location) {
                    return $location->getType()->getName();
                },
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ],
                'required' => false,
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
            'data_class' => Location::class,
            'has_description' => true,
        ]);
    }
}