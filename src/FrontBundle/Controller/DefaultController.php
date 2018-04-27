<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');
    }
    public function contactUsAction()
    {
        return $this->render('FrontBundle:Default:contact.html.twig');
    }
    public function aboutUsAction()
    {
        return $this->render('FrontBundle:Default:aboutUs.html.twig');
    }
    public function registerAction()
    {
        return $this->render('@Front/register.html.twig');
    }
}
