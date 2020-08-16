<?php

namespace App\Form;

use App\Entity\Panne;
use DateTime;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminPanneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motif')
            ->add('date_panne',null,[
                'widget' => 'single_text',
                'data' => new DateTime(),
                
            ])
            ->add('est_resolu',null,[
                'label' => ' est résolu'
            ]);
            
           
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Panne::class,
        ]);
    }
}
