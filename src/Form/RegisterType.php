<?php

namespace App\Form;

use App\Entity\User;
use App\Form\DataTransformer\PhoneTransformer;
use App\Form\RegisterType\GradeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('email', TextType::class, ['label' => 'E-mail'])
            ->add('last_name', TextType::class, ['label' => 'Фамилия'])
            ->add('first_name', TextType::class, ['label' => 'Имя'])
            ->add('phone', TelType::class, ['label' => 'Телефон',
                'attr' => ['data-mask' => '8 (999) 999-99-99']])
            ->add('grade', GradeType::class, [
                'label' => 'Образование',
            ])
            ->add('personal_data', CheckboxType::class, ['label' => 'Я даю согласие на обработку моих личных данных', 'required'=>false])
            ->add('submit', SubmitType::class, ['label' => 'Зарегистрироваться']);

        $builder->get('phone')->addViewTransformer(new PhoneTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
