<?php

namespace App\Form;

use App\Entity\Reservatie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservatieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Tijd')
            ->add('Datum')
            ->add('Hoeveelheid')
            ->add('Stoelen')
            ->add('Gebruiker', null, [
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservatie::class,
        ]);
    }
}
