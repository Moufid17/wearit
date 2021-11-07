<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class, 
            [
                'label' => 'FirstName',
                'attr' => [
                    'placeholder' => 'Marc'
                ]
            ])
            ->add('lastname',TextType::class, [
                'label' => 'LastName',
                'attr' => [
                    'placeholder' => 'ADAMS'
                ]
            ])
            ->add('email',EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'marc.adams@xyz.com'
                ]
            ])
            ->add('password',RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => "The passwords don't match.",
                'label' => 'Password',
                'required' => true,
                'first_options' => [
                    'label' => "Password",
                    'attr' => [
                        'placeholder' => '**********'
                    ]
                ],
                'second_options' => [
                    'label' => "Confirm Password",
                    'attr' => [
                        'placeholder' => '**********'
                    ]
                ]

            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Register',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
