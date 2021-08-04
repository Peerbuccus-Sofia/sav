<?php

namespace App\Form;

use App\Entity\Panne;
use App\Entity\Piece;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddPanneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $currentdate = new \DateTime('now');

        $builder
            ->add('description', TextareaType::class)
            ->add('datePanne', HiddenType::class, [
                'empty_data' => $currentdate
            ])
            ->add('etat', HiddenType::class, [
                'empty_data' => 0
            ])   
            ->add('piece', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Choisir une pièce',
                'required' => false

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Panne::class,
        ]);
    }
}
