<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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
            ->add('password',PasswordType::class,[
                'label' => 'Password',
                'attr' => [
                    'placeholder' => '**********'
                ]
            ])
            ->add('cpassword',PasswordType::class,[
                'label' => 'Confirm Password',
                'mapped' => false,
                'attr'  => [
                    'placeholder' => '**********'
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Submit',
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
