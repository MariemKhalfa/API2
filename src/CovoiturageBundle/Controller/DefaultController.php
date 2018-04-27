<?php

namespace CovoiturageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $covs = $em->getRepository("CovoiturageBundle:Covoiturage")->findCovoiturages();
        return $this->render('CovoiturageBundle:Default:index.html.twig', array("covs" => $covs));

    }
}
