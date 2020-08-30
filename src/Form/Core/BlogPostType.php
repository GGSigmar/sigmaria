<?php

namespace App\Form\Core;

use App\Entity\Core\BlogPost;
use App\Entity\Core\Release;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('release', EntityType::class, [
                'required' => false,
                'class' => Release::class,
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
            'data_class' => BlogPost::class,
            'has_description' => true,
        ]);
    }
}