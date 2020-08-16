<?php

namespace App\Form\Setting;

use App\Entity\Setting\SettingFoundation;
use App\Form\Core\BaseEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingFoundationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sortOrder', IntegerType::class, [])
        ;
    }

    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SettingFoundation::class,
            'has_handle' => true,
            'has_description' => true,
        ]);
    }
}