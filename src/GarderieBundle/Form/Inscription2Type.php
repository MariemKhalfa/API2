<?php

namespace GarderieBundle\Form;

use FOS\UserBundle\Event\FormEvent;
use FrontBundle\Entity\Enfant;
use PidevBundle\Repository\EnfantRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Inscription2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idGarderie',EntityType::class,array('class'=>'GarderieBundle\Entity\Garderies','choice_label'=>'nom','multiple'=>false,'label'=>'Garderie'))
            ->add('Rechercher',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GarderieBundle\Entity\Inscription',
            'usr' => 1,
        ));
        $resolver->setRequired('usr'); // Requires that currentOrg be set by the caller.
        $resolver->setAllowedTypes('usr', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'garderiebundle_inscription';
    }


}
