<?php

namespace MedecinBundle\Controller;

use MedecinBundle\Entity\Commentaire;
use MedecinBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PublicationController extends Controller
{
    public function ajoutPublicationAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $publication=new Publication();
        $publication->setTitre($request->get('titre'));
        $publication->setContenu($request->get('contenu'));
        $date=$request->get('date');
        $publication->setDate(new \DateTime("$date"));
        $publication->setPicpath($request->get('image'));
        $parent=$em->getRepository('FrontBundle:User')->findOneBy(array('id'=>$request->get('idParent')));
        $publication->setIdParent($parent);
        $em->persist($publication);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($publication);
        return new JsonResponse($formatted);
    }
    public function ajoutCommentaireAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $commentaire=new Commentaire();


        $commentaire->setCommentaire($request->get('commentaire'));


        $parent=$em->getRepository('FrontBundle:User')->findOneBy(array('id'=>$request->get('idParent')));
        $publication=$em->getRepository('MedecinBundle:Publication')->findOneBy(array('id'=>$request->get('idPub')));
        $commentaire->setIdParent($parent);
        $commentaire->setIdPub($publication);
        $em->persist($commentaire);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($publication);
        return new JsonResponse($formatted);
    }
}
