<?php

namespace RecetteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RecetteBundle:Default:index.html.twig');
    }
    public function AllRecetteJsonAction()
    {
        $Recette=$this->getDoctrine()->getManager()->getRepository('RecetteBundle:Recette')->findAll();
        $Serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $Serializer->normalize($Recette);
        return new JsonResponse($formatted);
    }

}

