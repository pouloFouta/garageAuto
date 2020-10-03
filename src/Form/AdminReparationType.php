<?php

namespace App\Form;

use DateTime;
use DateTimeZone;
use App\Entity\Vehicule;
use App\Entity\Reparation;
use App\Form\AdminPanneType;
use App\Form\AdminVehiculeType;
use App\Repository\ReparationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdminReparationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        
       
       
        $builder
            ->add('description')
            ->add('date_entree',null,[
                'label' => 'Date entrée',
                'widget' => 'single_text',
                'data' => new DateTime('now', new DateTimeZone('Europe/Brussels')),
                
                


            ])
            ->add('date_sortie',null,[
                'label' => 'Date sortie',
                'widget' => 'single_text',
                // je dis ici que la date de sortie estimé est d'1 semaine mais peut-être modifiable
                // par la suite via le bouton édit de cette réparation
                'data' => new DateTime('+ 1 week', new DateTimeZone('Europe/Brussels'))
                //'empty_data' => 'indeterminé',
                //'required'   => false
                

            ])
            ->add('statut',ChoiceType::class, [
                'choices' => [
                    'enregistré' => 'enregistré',
                    'en cours' => 'en cours de réparation',
                    'en attente de pièces' => 'en attente de pièces',
                    'terminé' =>'terminé']]);
            
            $builder->add('vehicule',AdminVehiculeType::class ,[

                           'label' => false,
                            
                            
            /*'class' => Reparation::class,
                            'query_builder' => function (ReparationRepository $er) {
                                return $er->createQueryBuilder('r')
                                    ->orderBy('r.vehicule', 'ASC');
                            },
                           'choice_label' => 'vehicule',*/ 
               
            ]);

            $builder->add('pannes', CollectionType::class, 
                [
                'label' => false,    
                'entry_type' => AdminPanneType::class,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true
               
                
              
                ]);
            
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reparation::class,
        ]);
    }
}
