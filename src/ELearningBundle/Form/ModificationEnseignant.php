<?php

namespace ELearningBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class ModificationEnseignant extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin',TextType::class,array('label' => 'CIN'))
            ->add('photo',TextType::class,array('label' => 'photo'))
            ->add('nom',TextType::class,array('label' => 'Nom'))
            ->add('prenom',TextType::class,array('label' => 'Prenom'))
            ->add('email',TextType::class,array('label' => 'Email'))
            ->add('description',TextType::class,array('label' => 'Description'))
            ->add('specialite',TextType::class,array('label' => 'Specialite'))
            ->add('telephone',TextType::class,array('label' => 'Telephone'))
            ->add('Modifier',SubmitType::class);


    }
     public function getParent()
    {
        return BaseRegistrationFormType::class;
    }

    public function getName()
    {
        return 'app_user_registration';
    }



}
