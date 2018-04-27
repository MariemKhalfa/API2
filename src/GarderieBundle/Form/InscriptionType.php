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

class InscriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {$usr=$options['usr'];
echo $usr;
echo "kfkfkkf";
        $builder ->add('nomparent')->add('adresse')->add('jourArriv')->add('commentaires')->add('nurserie')->add('repas')

            ->add('idenfant',EntityType::class,array('class'=>'FrontBundle\Entity\Enfant','choice_label'=>'Age',
                'query_builder' => function (\FrontBundle\Repository\EnfantRepository $ur) use($usr) {
                    return $ur->findAllUsersByEntreprise($usr);

                },'multiple'=>false,))->add('langues',ChoiceType::class, array('query_builder' => function (\FrontBundle\Repository\EnfantRepository $ur) use($usr) {
                return $ur->findAllUsersByEntreprise($usr);
            },'multiple'=>false,))

            ->add('Submit',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Garderie1Bundle\Entity\Inscription',
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
        return 'garderie1bundle_inscription';
    }


}
