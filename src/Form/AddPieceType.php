<?php

namespace App\Form;

use App\Entity\Piece;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPieceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentdate = new \DateTime('now');

        $builder
            ->add('libelle', ChoiceType::class, [
                'choices' => [
                    'Ecran' => 'Ecran',
                    'Batterie' => 'Batterie',
                    'Connecteur de charge' => 'Connecteur de charge',
                    'Camera avant' => 'Camera avant',
                    'Camera arrière' => 'Camera arrière',
                    'Micro' => 'Micro',
                    'Hautparleur' => 'Hautparleur',
                    'Vitre arrière' => 'Vitre arrière',
                    'Châssis' => 'Châssis',                    	
                    'Ecouteur interne' => 'Ecouteur interne',                    	
                    ]
            ]
            
            )
            ->add('prix')
            ->add('etat', HiddenType:: class, [
                'empty_data' => 'en stock'
            ])
            ->add('created_up', HiddenType::class, [
                'empty_data' => $currentdate])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Piece::class,
        ]);
    }
}
