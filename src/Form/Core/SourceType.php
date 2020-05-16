<?php

namespace App\Form\Core;

use App\Entity\Core\Source;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourceType extends AbstractType
{
    public function getParent()
    {
        return BaseEntityType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sourceProductLink', TextType::class, [
                'label' => 'Link do produktu',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Source::class,
            'has_handle' => true,
            'has_description' => true,
        ]);
    }
}