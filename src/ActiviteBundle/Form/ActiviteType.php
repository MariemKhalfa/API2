<?php

namespace ActiviteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class ActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {$builder
        ->add('type',TextType::class,array('label' => 'type'))
        ->add('ageMin',NumberType::class,array('label' => 'ageMin'))
        ->add('adresse',TextType::class,array('label' => 'adresse'))
        ->add('date',DateType::class,array('label' => 'date'))
        ->add('heure',TimeType::class,array('label' => 'heure   '))
        ->add('image',FileType::class,array('data_class' => null,'label'=>"insérez une image"))
        ->add('description', TextareaType::class, array('label'=>'Ajouter une description'))
        ->add('Modifier',SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ActiviteBundle\Entity\Activite'
        ));
    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }


    public function getBlockPrefix()
    {
        return 'activite_bundle_activite';
    }
}
