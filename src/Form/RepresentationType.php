<?php

namespace App\Form;

use App\Entity\Representation;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
        'label' => 'Titre'
    ] )
            ->add('content', TextType::class, [
                'label' => 'Description'
            ] )
            ->add('date', DateTimeType::class, [
                'label' => 'Date',
                'data' => new DateTime(),
            ])
            ->add('adress', TextType::class, [
                'label' => 'Lieu'
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Representation::class,
        ]);
    }
}
