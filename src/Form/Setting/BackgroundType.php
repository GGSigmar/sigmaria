<?php

namespace App\Form\Setting;

use App\Entity\Core\Ability;
use App\Entity\Core\Feat;
use App\Entity\Core\Lore;
use App\Entity\Core\Skill;
use App\Entity\Setting\Background;
use App\Form\Core\BaseEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BackgroundType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('abilityBoosts', EntityType::class, [
                'class' => Ability::class,
                'label' => 'Premie do cech',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('trainedSkill', EntityType::class, [
                'required' => false,
                'label' => 'Wytrenowana umiejętność',
                'class' => Skill::class,
                'placeholder' => 'Wybierz umiejętność',
            ])
            ->add('trainedLore', EntityType::class, [
                'required' => false,
                'label' => 'Wytrenowana dziedzina wiedzy',
                'class' => Lore::class,
                'placeholder' => 'Wybierz dziedzinę wiedzy',
            ])
            ->add('feat', EntityType::class, [
                'required' => false,
                'label' => 'Atut',
                'class' => Feat::class,
                'placeholder' => 'Wybierz atut',
            ])
            ->add('atypicalAbilityBoosts', TextType::class, [
                'required' => false,
                'label' => 'Nietypowe premie do cech',
            ])
            ->add('atypicalRules', TextType::class, [
                'required' => false,
                'label' => 'Nietypowe zasady',
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
            'data_class' => Background::class,
        ]);
    }
}