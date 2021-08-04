<?php

namespace App\Form;

use App\Entity\Dossier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AddDossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $currentdate = new \DateTime('now');
        $date = date("YmdHis");

        $builder
            ->add('num', HiddenType::class, [
                'empty_data' => "$date"
            ])
            ->add('statut', HiddenType::class, [
                'empty_data' => 'Nouveau'
                ])
            ->add('dateDossier', HiddenType::class, [
                'empty_data' => $currentdate
            ])
            ->add('estimation')
            ->add('acompte')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Réparation' => 'Réparation',
                    'Diagnostic' => 'Diagnostic'
                ],
                'expanded' => true,
                'multiple' => false,
                'label_attr'=>[
                    'class'=>'radio-inline'
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