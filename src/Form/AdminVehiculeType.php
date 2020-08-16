<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Personne;
use App\Entity\Vehicule;
use App\Form\PersonneType;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero_chassis',null,[
                'label' => 'Numéro de chassis'
            ])
            ->add('immatriculation' ,null,[

                'required' => false
            ])
            ->add('anneeFabrication',null,[
                'label' => 'Année de fabrication',
                'widget' => 'single_text',
                
            ])
            ->add('marque')
            ->add('modele',null,[
                'label' => 'Modèle'
            ])
            ->add('couleur')
            ->add('carburant',ChoiceType::class, [
                'choices' => [
                    'essence' => 'essence',
                    'diesel' => 'diesel',
                    'hybrid' => 'hybrid',
                    'gaz' =>'gaz']])
            ->add('kilometrage_achat',null,[
                'label' => 'Kilométrage achat',
                 'required' => false
            ])
            ->add('kilometrage_actuel',null,[
                'label' => 'Kilométrage actuelle'
            ])
            ->add('nbPortes', ChoiceType::class,[
                'choices' => [
                    '3' => '3',
                    '5' => '5'],
                'label' => 'Nombre de portes'
            ])
            ->add('puissance' )
            ->add('transmission', ChoiceType::class,[
                'choices' => [
                    'manuelle' => 'manuelle',
                    'automatique' => 'automatique'

            ]])
            ->add('options')
           
            ->add('client', ClientType::class,[

                   //'mapped' => false,

                   'required' => false,
                   
                
                
                'label' => false
 ]); 

 
                
           
           
           /* ->add('client', EntityType::class , [
                'class' => Client::class,
                'data' => 'moi',
                'choice_label' => function($client){
               return   $client->getPrenom() . " " . strtoupper($client->getNom());
            
                }




                 

            ]);*/
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
