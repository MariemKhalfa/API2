<?php

namespace GarderieBundle\Form;

use FrontBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GarderiesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('adresse')
            ->add('telephone')
            ->add('image', FileType::class,
                array('label' => "insérez une image"))
            ->add('email')
            ->add('descriptif', TextareaType::class)
            ->add('langues', ChoiceType::class,
                array(
                    'choices' => array('FR' => 'FR', 'EN' => 'EN'))
            )
            ->add('dateOuverture')
            ->add('dateFermeture')
            ->add('rating', HiddenType::class)
            ->add('cout')
            ->add('heureDeb')
            ->add('heureFin')
            ->add('latitude', HiddenType::class)
            ->add('longitude', HiddenType::class)
            ->add('proprietaire', EntityType::class,
                array(
                    'class' => 'FrontBundle\Entity\User',
                    'choice_label' => 'username',
                    'query_builder' => function (UserRepository $ur) {
                        return $ur->SelectPropGarderie();
                    },
                    'multiple' => false,))
            ->add('Ajouter', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GarderieBundle\Entity\Garderies'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'garderiebundle_garderies';
    }


}
