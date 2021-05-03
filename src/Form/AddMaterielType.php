<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('marque')
            ->add('model')
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Neuf' => 'Neuf',
                    'Bon état' => 'Bon état',
                    'Abimé' => 'Abimé',
                    'Très abimé' => 'Très abimé',

                    ],
                ]
                )
            ->add('compte')
            ->add('mdp')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}