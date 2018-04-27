<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => 'email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'username', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'password'),
                'second_options' => array('label' => 'password confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('CIN',TextType::class,array('label'=>'CIN'))
            ->add('nom',TextType::class,array('label' => 'Nom'))
            ->add('prenom',TextType::class,array('label' => 'Prenom'))
            ->add('sexe',ChoiceType::class,array(
                'choices'  => array(
                    'Femme' => 'Femme',
                    'Homme' => 'Homme',
                )))->add('covoiturage', CheckboxType::class, array(
                'label'    => 'Covoitureur',
                'required' => false,
            ))
            ->add('babysitter', CheckboxType::class, array(
                'label'    => 'babysitter',
                'required' => false,
            ))
            ->add('dateNaissance',DateType::class)
            ->add('rue',TextType::class,array('label' => 'Rue'))
            ->add('nbreEnfants',IntegerType::class)
            ->add('ville',TextType::class,array('label' => 'Ville'))
            ->add('codePostal',TextType::class,array('label' => 'Code Postal'))
            ->add('telephone',TextType::class,array('label' => 'Telephone'))
            ->add('roles',ChoiceType::class,array('choices'=>array('GARDERIE'=>'ROLE_GARDERIE','PARENT'=>'ROLE_PARENT'),'required'=>true,'multiple'=>true,))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_token_id' => 'registration',
        ));
    }

    // BC for SF < 3.0

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fos_user_registration';
    }
}
