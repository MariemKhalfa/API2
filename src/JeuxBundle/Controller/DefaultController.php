<?php

namespace JeuxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JeuxBundle:Default:index.html.twig');
    }
}
