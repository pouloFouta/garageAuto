<?php

namespace App\Form;

use DateTime;
use DateTimeZone;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ClientLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_location',null,[
                'label' => 'Date location',
                'widget' => 'single_text',
                //'data' => new DateTime('now', new DateTimeZone('Europe/Brussels'))
            ])
            ->add('date_fin',null,[
                'label' => 'Date de fin ',
                'widget' => 'single_text',
                //'data' => new DateTime('now', new DateTimeZone('Europe/Brussels'))

               
            ])
           
            ->add('vehicule')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
