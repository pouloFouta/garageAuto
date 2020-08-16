<?php

namespace App\Form;


use App\Entity\Vente;
use App\Form\AdminVehiculeType;
use App\Form\AdminVehiculeVenteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminVenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 

        -> add('montant', null,[

            'label' => 'Prix'    
       
            ])
        

            -> add('statutVente', ChoiceType::class,[
                'choices' => [
                    'libre' => 'libre',
                    'reservé' => 'réservé'],
                'label' => 'statut vente'
            ])


              
         -> add('vehicule', AdminVehiculeVenteType::class ,[

            'label' => false
            ]);
            /*->add('date_achat' ,null,[
               'label' => 'date achat',
               'widget' => 'single_text',
                
                
            ]);*/
           
            
            
             

             /*$builder ->add('imageVehicule', FileType::class ,[

                    'label' => 'image du véhicule',
                     'mapped'=> false
                     
             ]);*/
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vente::class,
        ]);
    }
}
