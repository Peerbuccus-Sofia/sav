<?php

namespace App\Form;

use App\Entity\Dossier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AddDossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $currentdate = new \DateTime('now');

        $builder
            ->add('statut', HiddenType::class, [
                'empty_data' => 'Nouveau'
                ])
            ->add('dateDossier', HiddenType::class, [
                'empty_data' => $currentdate
            ])
            ->add('estimation')
            ->add('acompte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
}