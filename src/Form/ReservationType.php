<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname',TextType::class,[
                    'label' => 'Nom',
            ])
            ->add('firstname',TextType::class,[
                'label' => 'Prénom',
            ])
            ->add('mail',EmailType::class,[
                'label' => 'Mail',
            ])
            ->add('message',TextareaType::class,[
                'label' => 'Message',
                'attr' => [
                    'rows' => 7,
                ]
            ])

        ;
    }
}
