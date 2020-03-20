<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Форма регистрации пользователя
 *
 * @package App\Form
 */
class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'E-mail'])
            ->add('last_name', TextType::class, ['label' => 'Фамилия'])
            ->add('first_name', TextType::class, ['label' => 'Имя'])
            ->add('phone', TelType::class, ['label' => 'Телефон',
                                            'attr' => ['data-mask' => '8 (999) 999-99-99']])
            ->add('grade', ChoiceType::class, [
                'choices' => array_flip(User\Grade::NAMES),
                'label'   => 'Образование',
            ])
            ->add('submit', SubmitType::class, ['label' => 'Зарегистрироваться']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
