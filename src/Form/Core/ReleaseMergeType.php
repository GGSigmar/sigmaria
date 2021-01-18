<?php


namespace App\Form\Core;

use App\Entity\Core\Release;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ReleaseMergeType extends AbstractType
{
    public const FIELD_RELEASES = 'releases';
    public const FIELD_NAME = 'name';
    public const LAUNCH_DATE_NAME = 'launchDate';
    public const FIELD_CONTENT_VERSION = 'contentVersion';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::FIELD_NAME, TextType::class)
            ->add(self::FIELD_CONTENT_VERSION, TextType::class)
            ->add(self::LAUNCH_DATE_NAME, DateType::class)
            ->add(self::FIELD_RELEASES, EntityType::class, [
                'class' => Release::class,
                'required' => true,
                'multiple' => true,
                'attr' => [
                    'class' => 'js-example-basic-multiple'
                ],
            ])
        ;
    }
}