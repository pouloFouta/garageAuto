<?php

namespace App\Form;

use DateTime;
use DateTimeZone;
use App\Entity\Commande;
use App\Form\AdminLigneCommandeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdminCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_commande',null,[
                'label' => 'Date commande',
                'widget' => 'single_text',
                'data' => new DateTime('now', new DateTimeZone('Europe/Brussels')),
                
                


            ])
            //->add('total')
            ->add('etat',ChoiceType::class,[
                'choices' => [
                    'envoyé' => 'envoyé',
                    'reçu' => 'reçu']])
            ->add('reparation')
            ->add('fournisseur');

            $builder->add('ligneCommandes' , CollectionType::class, 
            [
            'label' => false,    
            'entry_type' => AdminLigneCommandeType::class,
            'prototype' => true,
            'allow_add' => true,
            'allow_delete' => true
           
            
          
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
