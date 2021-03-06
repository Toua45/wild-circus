<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Representation;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RepresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
        'label' => 'Titre'
    ] )
            ->add('content', TextareaType::class, [
                'label' => 'Description'
            ] )

            ->add('date', DateTimeType::class, [
                'label' => 'Date',
                'data' => new DateTime(),
            ])
            ->add('adress', TextType::class, [
                'label' => 'Lieu'
            ] )
            ->add('artists', EntityType::class, [
                'label' => 'Artistes',
                'class' => Artist::class,
                'choice_label' => 'firstname',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Representation::class,
        ]);
    }
}
