<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminVehiculeVenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero_chassis',null,[
                'label' => 'Numéro de chassis'
            ])
            
            ->add('marque')
            ->add('couleur')
            ->add('carburant',ChoiceType::class, [
                'choices' => [
                    'essence' => 'essence',
                    'diesel' => 'diesel',
                    'hybrid' => 'hybrid',
                    'gaz' =>'gaz']])
            
            ->add('kilometrage_actuel',null,[
                'label' => 'Kilométrage actuelle'
            ])
            ->add('nbPortes', ChoiceType::class,[
                'choices' => [
                    '3' => '3',
                    '5' => '5',],
                'label' => 'Nombre de portes'
            ])
            ->add('transmission',ChoiceType::class,[
                'choices' => [
                    'manuelle' => 'manuelle',
                    'automatique' => 'automatique'

            ]])
            ->add('options')
            ->add('modele',null,[
                'label' => 'Modèle'
            ])
            ->add('puissance')
            ->add('anneeFabrication',null,[
                'label' => 'Année de Fabrication',
               
                    'widget' => 'single_text',
                    
               
            ]);
            
            //remplacer par imageVehicule si possible
            $builder ->add('imageFichier', FileType::class ,[

                'label' => 'Image du véhicule',
                 'mapped'=> false,
                 'required' => false
                 
         ]);
    
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
