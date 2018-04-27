<?php

namespace JeuxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JeuxController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function memoryAction()
    {
        return $this->render('@Jeux/Default/memory.html.twig');
    }

    public function mathAction()
    {
        return $this->render('JeuxBundle:Default:quiz.html.twig');
    }

}
