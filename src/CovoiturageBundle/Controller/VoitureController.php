<?php

namespace CovoiturageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VoitureController extends Controller
{
    public function ajoutVoitureAction()
    {
        return $this->render('CovoiturageBundle:Voiture:ajout_voiture.html.twig', array(
            // ...
        ));
    }

    public function detailVoitureAction()
    {
        return $this->render('CovoiturageBundle:Voiture:detail_voiture.html.twig', array(
            // ...
        ));
    }

    public function supprimerVoitureAction()
    {
        return $this->render('CovoiturageBundle:Voiture:supprimer_voiture.html.twig', array(
            // ...
        ));
    }

    public function modifierVoitureAction()
    {
        return $this->render('CovoiturageBundle:Voiture:modifier_voiture.html.twig', array(
            // ...
        ));
    }

}
