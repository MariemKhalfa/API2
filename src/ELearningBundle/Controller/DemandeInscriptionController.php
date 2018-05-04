<?php

namespace ELearningBundle\Controller;


use ELearningBundle\Listener\CalendarEvent;
use ELearningBundle\Entity\DemandeInscription;
use ELearningBundle\Form\DemandeInscriptionType;
use ELearningBundle\Listener\LoadDataListener;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class DemandeInscriptionController extends Controller
{
    public function ajoutAction(Request $request,$idm,$idp)
    {
        $idMed=$request->get('idm');
        $idpar=$request->get('idp');
        $em = $this->getDoctrine()->getManager();
        $DM = new DemandeInscription();
        $Enfant = $em->getRepository('FrontBundle:Enfant')->findEnfants($idp);
        if ($request->isMethod('POST')){
            $medecin = $em->getRepository('FrontBundle:User')->find($idm);
            $enfant = $em->getRepository('FrontBundle:Enfant')->findOneBy(array('pseudonyme'=> $request->get('pseudonymeEnfant')));
           dump($enfant);
            $DM->setMedecinId($medecin);
            $DM->setEnfantId($enfant);
            $date=$request->get('dateDebut');
            $DM->setDateDebut($request->get('dateDebut'));
            $DM->setDescriptionDifficulte($request->get('description'));
            $em->persist($DM);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('ELearningBundle:DemandeInscription:AffecterEnfant.html.twig',array('Enfant'=>$Enfant,'idm'=>$idMed,'idp'=>$idpar));

    }
    public function afficheDemandeEnseignantAction(Request $request)
    {
        $idm=$this->getUser();
        $em = $this->getDoctrine();
        $Demande = $em->getRepository("ELearningBundle:DemandeInscription")->AllDemande($idm);
        return $this->render("ELearningBundle:DemandeInscription:AfficherDemandeInscription.html.twig", array("Demande"=>$Demande ));
    }
    public function AccepterDemandeAction(Request $request)
    {
        $id=$request->get('id');
        $em = $this->getDoctrine();
        $em->getRepository("ELearningBundle:DemandeInscription")->AccepterDemande($id);
        return $this->redirectToRoute('e_learning_afficherDemande');
    }
    public function RefuserDemandeAction(Request $request)
    {
        $id=$request->get('id');
        $em = $this->getDoctrine();
        $em->getRepository("ELearningBundle:DemandeInscription")->RefuserDemande($id);
        return $this->redirectToRoute('e_learning_afficherDemande');
    }
    public function calendarAction()
    {
        $LoadData=new LoadDataListener();
        $filter=array('filters',[]);
        $CalendarEvent=new CalendarEvent(new \DateTime('2018-04-04 20:00:00'),new \DateTime('2018-04-10 00:00:00'),[]);
        $LoadData->loadData($CalendarEvent);
        return $this->render('ELearningBundle:Enseignant:Calendar.html.twig');
    }
    public function LoadCalendarAction(){
        $em = $this->getDoctrine()->getManager();
        $idm=$this->getUser();
        $listeEvents = $em->getRepository('ELearningBundle:DemandeInscription')->DemandeAccepte($idm);
        $listEventsJson = array();
        foreach ($listeEvents as $event)
            $listEventsJson[] = array(
                'title' => $event->getEtat(),
                'start' => "" . ($event->getDateDebut()->format('Y-m-d H:i:s')) . "",
                'id' => "" . ($event->getId()) . ""
            );
        return new JsonResponse(array('events' => $listEventsJson));
    }
    public  function FindenfantAction($idp)
    {
        $em = $this->getDoctrine()->getManager();
        $Enfant = $em->getRepository('FrontBundle:Enfant')->findEnfants($idp);
        $Serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $Serializer->normalize($Enfant);
        return new JsonResponse($formatted);
    }

    public function AjoutDemandeInscriptionJsonAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $Demande= new DemandeInscription();
        $user=$em->getRepository('FrontBundle:User')->find($request->get('userId'));
        $Enfant=$em->getRepository('FrontBundle:Enfant')->findOneBy(array('pseudonyme' => $request->get('EnfantId')));
        $Demande->setEnfantId($Enfant);
        $Demande->setMedecinId($user);
        $Demande->setDescriptionDifficulte($request->get('descri'));
        $Demande->setDateDebut($request->get('datedebut'));
        $em->persist($Demande);
        $em->flush();
        $Serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $Serializer->normalize($Demande);
        return new JsonResponse($formatted);
    }
    public function AfficherDemandeAjaxAction($idm)
    {
        $em = $this->getDoctrine();
        $Demande = $em->getRepository("ELearningBundle:DemandeInscription")->AllDemande($idm);
        $Serializer= new Serializer([new ObjectNormalizer()]);
        $formatted = $Serializer->normalize($Demande);
        return new JsonResponse($formatted);
    }
}
