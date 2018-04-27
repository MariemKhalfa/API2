<?php

namespace BabysittingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bab = $em->getRepository("BabysittingBundle:Babysitting")->CurrentBabysittings();
        return $this->render('BabysittingBundle:Default:index.html.twig', array("bab" => $bab));
    }
}
