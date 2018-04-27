<?php

namespace EvenementBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('intitule')->add('nbParticipants')->add('budget')->add('date',DateTimeType::class, array(
        'placeholder' => array(
            'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
            'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second')))->
        add('categorie',ChoiceType::class, array(
            'choices' => array('parent' => 'parent', 'enfant' => 'enfant')))->add('image',FileType::class,array('label'=>"insérez une image"))->
        add('Ajouter',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EvenementBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'evenementbundle_evenement';
    }


}
