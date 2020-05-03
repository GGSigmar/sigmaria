<?php

namespace App\Form\Core\Embedded;

use App\Entity\Core\EntitySource;
use App\Entity\Core\Source;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntitySourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('source', EntityType::class, [
                'required' => false,
                'label' => 'Źródło',
                'class' => Source::class
            ])
            ->add('sourceStartingPageNumber', IntegerType::class, [
                'required' => false,
                'label' => 'Strona początkowa źródła',
            ])
            ->add('sourceEndingPageNumber', IntegerType::class, [
                'required' => false,
                'label' => 'Strona końcowa źródła',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EntitySource::class,
        ]);
    }
}