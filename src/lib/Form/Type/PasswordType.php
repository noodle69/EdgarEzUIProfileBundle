<?php

namespace Edgar\EzUIProfile\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType as PasswordFieldType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordFieldType::class, [
                'required' => true,
                'label' => 'Old password',
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordFieldType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => ['label' => 'New password'],
                'second_options' => ['label' => 'Repeat new password'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
            ]);
    }
}
