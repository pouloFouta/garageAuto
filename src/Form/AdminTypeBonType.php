<?php

namespace App\Form;

use App\Entity\TypeBon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminTypeBonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description_type', null, [
                'label' => 'Description du type de bon'   

            ])
            ->add('nb_points_necessaires', ChoiceType::class,[
                'choices' => [
                    '5' => '5',
                    '10' => '10',
                    '15' => '15',
                    '20' => '20'],
                'label' => 'Nombre de points nécéssaires pour ce type de bon'
            ])

            ->add('validite',null , [

                'label' => 'Validité',
                'widget' => 'single_text'
            ])


            ->add('quantite',ChoiceType::class,[
                'choices' => [
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'], 
                'label' => 'Quantité de bons  à générer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypeBon::class,
        ]);
    }
}
