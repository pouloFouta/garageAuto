<?php

namespace App\Form;

use App\Entity\Reparation;
use App\Entity\Specialite;
use App\Entity\GestionVehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminGestionVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaire')
            ->add('reparation')
           
            //->add('specialite')
            ->add('specialite', EntityType::class, [
               
                'class' => Specialite::class,
            
               
                'choice_label' => 'nomSpecialite',
            
                
                 //'multiple' => true,
                 //'expanded' => true,
            ])
            ->add('reparateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GestionVehicule::class,
        ]);
    }
}
