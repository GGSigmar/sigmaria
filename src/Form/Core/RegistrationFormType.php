<?php

namespace App\Form\Core;

use Symfony\Component\Form\AbstractType;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType
{
    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }
}