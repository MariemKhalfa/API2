<?php

namespace FrontBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('CIN',array('label' => 'CIN'))
            ->add('nom',array('label' => 'Nom'))
            ->add('prenom',array('label' => 'Prenom'))
            ->add('sexe',ChoiceType::class,array(
                'choices'  => array(
                    'Femme' => 'Femme',
                    'Homme' => 'Homme',
                )))
            ->add('dateNaissance',DateType::class)
            ->add('rue',array('label' => 'Rue'))
            ->add('ville',array('label' => 'Ville'))
            ->add('codePostal',array('label' => 'Code Postal'))
            ->add('telephone',array('label' => 'Telephone'));

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
