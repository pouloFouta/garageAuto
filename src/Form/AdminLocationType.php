<?php

namespace App\Form;

use DateTime;
use DateTimeZone;
use App\Entity\Location;
use App\Form\AdminVehiculeVenteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('date_location')
            
           // ->add('nb_jours')

                
             ->add('prix')
             ->add('statut_location',ChoiceType::class, [
                'label' => 'statut location',
                'choices' => [
                    'libre' => 'libre',
                    'loué' => 'loué',
                    'annulé' => 'annulé',
                    'payé' =>'payé']])
            //->add('client')
            -> add('vehicule', AdminVehiculeVenteType::class ,[

                'label' => false
                ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
