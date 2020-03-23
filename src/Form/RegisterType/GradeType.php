<?php

namespace App\Form\RegisterType;

use App\Entity\User\Grade;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GradeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => array_flip(Grade::NAMES),
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}