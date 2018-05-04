<?php

namespace ApiBundle\Controller;

use CovoiturageBundle\Entity\Covoiturage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CovoiturageController extends Controller
{

    public function newCovAction(Request$request)
    {
        $em=$this->getDoctrine()->getManager();
        $cov= new Covoiturage();
        $cov->setTitre($request->get('tit'));
        $date=new \DateTime($request->get("dat"));
        $cov->setDate($date);
        $heure=new \DateTime($request->get("hDep"));
        $cov->setHeureDep($heure);
        $cov->setLieuDep($request->get('lDep'));
        $cov->setLieuDest($request->get('lDest'));
        $cov->setDescription($request->get('desc'));
        $cov->setNbPlaces($request->get('nbr'));
        $p = $this->getDoctrine()->getManager()
            ->getRepository("FrontBundle:User")->find($request->get('cov'));
        $cov->setCovoitureur($p);
        $v = $em->getRepository("CovoiturageBundle:Covoiturage")
            ->find($request->get('voit'));
        $cov->setVoiture($v);
        var_dump($cov);
        $em->persist($cov);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($cov);
        return new JsonResponse($formatted);
    }

    public function findCovAction($id,$date)
    {
        $covs=$this->getDoctrine()->getManager()
            ->getRepository('CovoiturageBundle:Covoiturage')
            ->findDateCovoiturages($id,$date);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($covs);
        return new JsonResponse($formatted);
    }

    public function allCovAction($id)
    {
        $covs=$this->getDoctrine()->getManager()
            ->getRepository('CovoiturageBundle:Covoiturage')
            ->AutresCovoiturages($id);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($covs);
        return new JsonResponse($formatted);
    }

}
