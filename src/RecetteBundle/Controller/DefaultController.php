<?php

namespace RecetteBundle\Controller;

use RecetteBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function AllCommentaireJsonAction($id)
    {
        $Recette=$this->getDoctrine()->getManager()->getRepository('RecetteBundle:Recette')->verif($id);
        $Serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $Serializer->normalize($Recette);
        return new JsonResponse($formatted);
    }
   public function AjoutCommentaireJsonAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $commentaire= new Commentaire();
        $user=$em->getRepository('FrontBundle:User')->find($request->get('userId'));
       $Recette=$em->getRepository('RecetteBundle:Recette')->find($request->get('RecetteId'));
        $commentaire->setUserId($user);
        $commentaire->setRecetteId($Recette);
        $commentaire->setCommentaire($request->get('Commentaire'));
        $em->persist($commentaire);
        $em->flush();
       $Serializer= new Serializer([new ObjectNormalizer()]);
       $formatted = $Serializer->normalize($commentaire);
       return new JsonResponse($formatted);
   }
    public function UpdateRecetteJsonAction($id)
    {
        $Recette=$this->getDoctrine()->getManager()->getRepository('RecetteBundle:Recette')->updateCom($id);
        $Serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $Serializer->normalize($Recette);
        return new JsonResponse($formatted);
    }
}

