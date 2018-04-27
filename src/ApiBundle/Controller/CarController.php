<?php

namespace ApiBundle\Controller;

use AkApiBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class CarController extends Controller
{
    public function newVoitAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $voiture= new Car();
        $voiture->setMatricule($request->get('mat'));
        $voiture->setMarque($request->get('mar'));
        $voiture->setModele($request->get('mod'));
        $voiture->setCouleur($request->get('col'));
        $voiture->setNbSieges($request->get('nb'));
        $voiture->setProprio($request->get('prop'));
        $em->persist($voiture);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($voiture);
        return new JsonResponse($formatted);
    }

    public function findVoitAction($id)
    {
        $voitures=$this->getDoctrine()->getManager()
            ->getRepository('ApiBundle:car')
            ->MyCars($id);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($voitures);
        return new JsonResponse($formatted);
    }

    public function allVoitAction()
    {
        $voitures=$this->getDoctrine()->getManager()
            ->getRepository('ApiBundle:car')
            ->findAll();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($voitures);
        return new JsonResponse($formatted);
    }

    public function updateVoitAction()
    {
        return $this->render('ApiBundle:Voiture:update_voit.html.twig', array(
            // ...
        ));
    }

    public function deleteVoitAction()
    {
        return $this->render('ApiBundle:Voiture:delete_voit.html.twig', array(
            // ...
        ));
    }

}
