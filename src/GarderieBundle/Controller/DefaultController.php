<?php

namespace GarderieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GarderieBundle:Back:espaceGarderie.html.twig');
    }
}
