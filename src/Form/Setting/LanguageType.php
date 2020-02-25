<?php

namespace App\Form\Setting;

use App\Entity\Core\Rarity;
use App\Entity\Setting\Language;
use App\Entity\Setting\Script;
use App\Form\Core\BaseEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sortOrder', IntegerType::class, [
                'label' => 'Kolejność sortowania'
            ])
            ->add('rarity', EntityType::class, [
                'label' => 'Rzadkość',
                'class' => Rarity::class
            ])
            ->add('script', EntityType::class, [
                'required' => false,
                'label' => 'Pismo',
                'class' => Script::class,
                'placeholder' => 'Nie dotyczy',
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
            'data_class' => Language::class,
        ]);
    }
}