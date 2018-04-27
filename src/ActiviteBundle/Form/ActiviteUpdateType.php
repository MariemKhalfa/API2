<?php

namespace ActiviteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type')->add('age_min')->add('adresse')
            ->add('description')
            ->add('date')
            ->add('heure')
            ->add('heure')
            ->add('image',FileType::class,array('data_class' => null,'label'=>"insérez une image"))
            -> add('Modifier',SubmitType::class);  ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ActiviteBundle\Entity\Activite'
        ));
    }

    public function getBlockPrefix()
    {
        return 'activite_bundle_activite';
    }
}
