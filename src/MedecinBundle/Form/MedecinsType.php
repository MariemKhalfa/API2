<?php

namespace MedecinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedecinsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('prenom')->add('specialite',ChoiceType::class, array(
            'choices' => array('pediatre' => 'pediatre', 'dentiste' => 'dentiste')))->add('telephone')->add('adresse')->add('email')
            ->
            add('image',FileType::class,array('label'=>"insérez une image"))->
            add('Ajouter',SubmitType::class);    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MedecinBundle\Entity\Medecins'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'medecinbundle_medecins';
    }


}
