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

use Symfony\Bundle\FrameworkBundle\Tests\Functional\Bundle\TestBundle\DependencyInjection\TestExtension;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileFormType extends AbstractType
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
        $this->buildUserForm($builder, $options);

        $constraintsOptions = array(
            'message' => 'fos_user.current_password.invalid',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_token_id' => 'profile',
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
        return 'fos_user_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'Username:', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', EmailType::class, array('label' => 'Email:', 'translation_domain' => 'FOSUserBundle'))
            ->add('CIN',TextType::class,array('label'=>'CIN:'))
            ->add('nom',TextType::class,array('label' => 'Nom:'))
            ->add('prenom',TextType::class,array('label' => 'Prenom:'))
            ->add('sexe',ChoiceType::class,array(
                'choices'  => array(
                    'Femme' => 'Femme',
                    'Homme' => 'Homme',
                )))
            ->add('dateNaissance',DateType::class)
            ->add('rue',TextType::class,array('label' => 'Rue:'))
            ->add('ville',TextType::class,array('label' => 'Ville:'))
            ->add('codePostal',TextType::class,array('label' => 'Code Postal:'))
            ->add('telephone',TextType::class,array('label' => 'Telephone:'))
        ;
    }
}
