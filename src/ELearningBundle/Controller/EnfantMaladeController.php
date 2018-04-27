<?php

namespace ELearningBundle\Controller;

use ELearningBundle\Entity\EnfantMalade;
use ELearningBundle\Form\EnfantMaladeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EnfantMaladeController extends Controller
{
    public function ajoutAction(Request $request,$idm,$idp) {
        $Enfant= new EnfantMalade();
        $Form = $this->createForm(EnfantMaladeType::class,$Enfant);
        $Form->handleRequest($request);
        if($Form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
           $medecin=$em->getRepository('FrontBundle:User')->find($idm);
           $parent=$em->getRepository('FrontBundle:User')->find($idp);
            $Enfant->setIdp($parent);
            $Enfant->setIdm($medecin);
            $em->persist($Enfant);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('ELearningBundle:EnfantMalade:AffecterEnfant.html.twig',array('form'=>$Form->createView()));
    }
}
