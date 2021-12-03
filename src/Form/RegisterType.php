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
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class, 
                [
                    'label' => 'Firstname',
                    'constraints' => new Length([
                        'min' => 4,
                        'minMessage' => 'Firstname length must be at least 4.',
                        'max' => 15,
                        'maxMessage' => 'Firstname length must not exceed 15.'
                    ]),
                    'attr' => [
                        'placeholder' => 'Marc'
                    ]
                ]
            )
            ->add('lastname',TextType::class, [
                'label' => 'Lastname',
                'constraints' => new Length([
                    'min' => 3,
                    'minMessage' => 'Lastname length must be at least {{ limit }}.',
                    'max' => 15,
                    'maxMessage' => 'Lastname length must not exceed 15.'
                ]),
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
                
                'first_options' => [
                    'label' => "Password",
                    'required' => true,
                    'attr' => [
                        'placeholder' => '**********'
                    ]
                ],
                'second_options' => [
                    'label' => "Confirm Password",
                    'required' => true,
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
