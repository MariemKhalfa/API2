<?php

namespace ApiBundle\Controller;

use BabysittingBundle\Entity\Babysitting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BabysittingController extends Controller
{
    public function newBabAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $babysitting= new Babysitting();
        $babysitting->setTitre($request->get('tit'));
        //$babysitting->setDate($request->get('dat'));
       $date=new \DateTime($request->get("dat"));
        $babysitting->setDate($date);
       // $babysitting->setHeureDeb($request->get('deb'));
        $deb=new \DateTime($request->get("deb"));
        $babysitting->setHeureDeb($deb);
        //$babysitting->setHeureFin($request->get('fin'));
        $fin=new \DateTime($request->get("fin"));
        $babysitting->setHeureFin($fin);
        $babysitting->setAdresse($request->get('adr'));
        $babysitting->setDescription($request->get('desc'));
        $babysitting->setNbrEnfants($request->get('nbr'));
        $p = $this->getDoctrine()->getManager()
            ->getRepository("FrontBundle:User")->find($request->get('bab'));
        $babysitting->setBabysitteur($p);
        $em->persist($babysitting);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($babysitting);
        return new JsonResponse($formatted);
    }

    public function findBabAction($id,$date)
    {
        $babysittings=$this->getDoctrine()->getManager()
            ->getRepository('BabysittingBundle:Babysitting')
            ->findDateBabysittings($id,$date);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($babysittings);
        return new JsonResponse($formatted);
    }

    public function allBabAction($id)
    {
        $babysittings=$this->getDoctrine()->getManager()
            ->getRepository('BabysittingBundle:Babysitting')
            ->AutresBabysittings($id);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($babysittings);
        return new JsonResponse($formatted);
    }

    public function updateBabAction()
    {
        return $this->render('ApiBundle:Babysitting:update_bab.html.twig', array(
            // ...
        ));
    }

}
