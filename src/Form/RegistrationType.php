<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom' , TextType::class, [
                'help' => 'Votre prénom',
            ])
            ->add('nom',TextType::class, [
                'help' => 'Votre nom',
            ])
            ->add('email',EmailType::class, [
                'help' => 'Votre adresse email',
            ])
            ->add('mot_de_passe',PasswordType::class, [
                'help' => 'Tapez votre mot de passe de minimum 6 caractères',
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
