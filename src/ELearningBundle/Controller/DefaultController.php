<?php

namespace ELearningBundle\Controller;

use ELearningBundle\Form\ModificationEnseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ELearningBundle:Default:index.html.twig');
    }

    public function afficheAction()
    {
        $em = $this->getDoctrine();
        $Enseignant = $em->getRepository("FrontBundle:User")->findRoleEnseignant();
        return $this->render("ELearningBundle:Enseignant:AfficherEnseignant.html.twig", array("Enseignant" => $Enseignant));
    }

    public function afficheBackAction()
    {
        $em = $this->getDoctrine();
        $Enseignant = $em->getRepository("FrontBundle:User")->findRoleEnseignant();
        return $this->render("ELearningBundle:Enseignant:AfficherBackEnseignant.html.twig", array("Enseignant" => $Enseignant));
    }

    public function suppAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $Enseignant = $em->getRepository("FrontBundle:User")->find($id);
        $em->remove($Enseignant);
        $em->flush();

        return $this->redirectToRoute('e_learning_afficherBackEnseignant');
    }

    public function modifAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $Enseignant = $em->getRepository("FrontBundle:User")->find($id);
        $Form = $this->createForm(ModificationEnseignant::class, $Enseignant);

        $Form->handleRequest($request);
        if ($Form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Enseignant);
            $em->flush();
            return $this->redirectToRoute('e_learning_afficherBackEnseignant');
        }
        return $this->render('ELearningBundle:Enseignant:ModificationEnseignant.html.twig', array('form' => $Form->createView()));
    }

    function AjoutAction(Request $request)
    {
        $Enseignant = new Enseignant();

        if ($request->isMethod('POST')) {
            $Enseignant->set($request->get('username'));
            $Enseignant->set($request->get('email'));
            $Enseignant->set($request->get('mdp'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($Enseignant);
            $em->flush();
        }
        return $this->render('@ELearning/Enseignant/ajoutEnseignant.html.twig');
    }
}
