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

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                'label' => 'Email',
                'disabled' => true,
                'required' => true,
            ])
            ->add('firstname',TextType::class,[
                'label' => 'Firstname',
                'required' => true,
                'constraints' => new Length([
                    'min' => 4,
                    'minMessage' => 'Lastname length must be at least {{ limit }}.',
                    'max' => 15,
                    'maxMessage' => 'Lastname length must not exceed 15.'
                ])
            ])
            ->add('lastname',TextType::class,[
                'label' => 'Lastname',
                'required' => true,
                'constraints' => new Length([
                    'min' => 3,
                    'minMessage' => 'Lastname length must be at least {{ limit }}.',
                    'max' => 15,
                    'maxMessage' => 'Lastname length must not exceed 15.'
                ])
            ])
            ->add('old_password', PasswordType::class,[
                'label' => 'Current Password',
                'required' => true,
                'attr' => [
                    'placeholder' => '**********'
                ],
                'mapped' => false
            ])
            ->add('new_password',RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => "The passwords don't match.",
                'mapped' => false,
                'first_options' => [
                    'label' => "New Password",
                    'required' => true,
                    'attr' => [
                        'placeholder' => '**********'
                    ]
                ],
                'second_options' => [
                    'label' => "Confirm new Password",
                    'required' => true,
                    'attr' => [
                        'placeholder' => '**********'
                    ]
                ]

            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Update'
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
