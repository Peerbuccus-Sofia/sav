<?php

namespace App\Form;

use App\Entity\Panne;
use Symfony\Component\Form\AbstractType;
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Panne::class,
        ]);
    }
}
