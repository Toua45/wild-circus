<?php

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom'])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'])
            ->add('imageFile', VichImageType::class,
                [
                    'label' => 'Photo',
                    'required' => false,
                ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Date de naissance'])
            ->add('role', TextType::class, [
                'label' => 'Rôle'])
            ->add('category', null, [
                'label' => 'Univers',
                'choice_label' => 'name'])
            ->add('representation', null, [
                'label' => 'Représentation',
                'choice_label' => 'title'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
