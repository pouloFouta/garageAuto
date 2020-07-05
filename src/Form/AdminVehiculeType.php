<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Personne;
use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero_chassis',null,[
                'label' => 'numéro de chassis'
            ])
            ->add('immatriculation')
            ->add('marque')
            ->add('modele',null,[
                'label' => 'modèle'
            ])
            ->add('couleur')
            ->add('carburant')
            ->add('kilometrage_achat',null,[
                'label' => 'kilométrage achat'
            ])
            ->add('kilometrage_actuel',null,[
                'label' => 'kilométrage actuelle'
            ])
            ->add('nb_portes',null,[
                'label' => 'Nombre de portes'
            ])
            ->add('transmission')
            ->add('options')
            ->add('client', EntityType::class , [
                'class' => Client::class,
                'data' => 'moi',
                'choice_label' => function($client){
               return   $client->getPrenom() . " " . strtoupper($client->getNom());
            
                }




                 

            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
