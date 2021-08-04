<?php

namespace App\Form;

use App\Entity\Dossier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddTypedossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Nouveau' => 'Nouveau',
                    'A traiter' => 'A traiter',
                    'En cours de traitement' => 'En cours de traitement',
                    'Récupéré' => 'Récupéré',
                    'Terminé' => 'Terminé',
                    'Clôturé' => 'Clôturé',
			        'Annulé' => 'Annulé'
                ]    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
}
