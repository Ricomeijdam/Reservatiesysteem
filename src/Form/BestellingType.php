<?php

namespace App\Form;

use App\Entity\Bestelling;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BestellingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Datum')
            ->add('Gerecht')
            ->add('Reservatie')
            ->add('Factuur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bestelling::class,
        ]);
    }
}
