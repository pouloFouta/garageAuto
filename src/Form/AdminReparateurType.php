<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Reparateur;
use App\Entity\Specialite;
use App\Form\SpecialiteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdminReparateurType extends AbstractType
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
            'help' => 'Tapez votre mot de passe de minimum 8 caractères',
        ])
        
        /*->add('specialite', null, [

            'mapped' => false
        ])*/
        
        ->add('adresse')
        ->add('telephone')

           
       
        /*->add('mot_de_passe',PasswordType::class, [
            'help' => 'Tapez votre mot de passe de minimum 8 caractères',
        ])
        ->add('confirmation_mot_de_passe',PasswordType::class, [
            'help' => 'confirmer le mot de passe',
        ])*/
            

               
           ->add('specialite',EntityType::class,[
                
                'class' => Specialite::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Spécialité(s) du réparateur',
     
                'choice_label' => function ($specialite) {
                    return $specialite->getNomSpecialite();
                }
               
            ])

            ->add('roles',ChoiceType ::class ,[
                
                  'choices' => [
                      'utilisateur' => 'ROLE_USER',
                      'reparateur' => 'ROLE_REPARATEUR',
                      'administrateur' => 'ROLE_ADMIN'
                  ], 

                'multiple' => true,
                'expanded' => true,
                'label' => 'role du réparateur'
     
                
               
            ]); 
                
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
