<?php
// src/Form/RegistrationFormType.php
namespace App\Form\Security;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'back.form.inscription.label.email',
                'required' => true,
                'empty_data' => '', // Définir la valeur par défaut à une chaîne vide
                'attr' => ['placeholder' => 'back.form.inscription.placeholder.email'],
                'label_attr' => ['for' => 'floatingInputName'],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'back.form.inscription.error.confirm_password',

                'first_options'  => [
                    'label' => 'back.form.inscription.label.password',
                    'attr' => ['placeholder' => 'back.form.inscription.placeholder.confirm_password'],
                    'label_attr' => ['for' => 'floatingInputName']],

                'second_options' => [
                    'label' => 'back.form.inscription.label.confirm_password',
                    'attr' => ['placeholder' => 'back.form.inscription.placeholder.confirm_password'],
                    'label_attr' => ['for' => 'floatingInputName']],

                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'back.form.inscription.label.submit',
            ]);
    }
}