<?php

namespace App\Form;

use App\Entity\MiseEnLocation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminMiseLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prixParJour',null,[
                'label' => 'Prix par Jour'
            ])
            ->add('statutMise',ChoiceType::class, [
                'label' => 'statut mise en location',
                'choices' => [
                    'libre' => 'libre',
                    'reservé' => 'reservé',
                    
                    ]])
            ->add('vehicule', AdminVehiculeVenteType::class,[
                'label' => false
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MiseEnLocation::class,
        ]);
    }
}
