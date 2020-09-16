<?php

namespace App\Form;

use DateTime;
use DateTimeZone;
use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminFactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_facture',null,[
                'label' => 'Date émission',
                'widget' => 'single_text',
                'data' => new DateTime('now', new DateTimeZone('Europe/Brussels')),
                
                


            ])
            ->add('TVA')
            ->add('montant',null,[
               'label' => 'Montant hors TVA'

            ])
            //->add('responsable')
            ->add('client')
            ->add('libelle')
            ->add('est_paye' ,ChoiceType::class,[
                'choices' => [
                    'non' => 'non',
                    'oui' => 'oui']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
