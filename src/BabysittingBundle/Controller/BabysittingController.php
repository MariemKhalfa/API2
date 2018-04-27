<?php

namespace BabysittingBundle\Controller;

use BabysittingBundle\Entity\Babysitting;
use FrontBundle\Entity\User;
use BabysittingBundle\Form\BabysittingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

class BabysittingController extends Controller
{

    public function ajouterBabysittingAction(Request $request)
    {
        $baby = new Babysitting();

        $form = $this->createForm(BabysittingType::class, $baby);
        $form->handleRequest($request);

        if ( $request->isMethod('post')  ) {

            $baby->setTitre($request->get("titre"));

            $timeD=new \DateTime($request->get("heureD"));
            $timeF=new \DateTime($request->get("heureF"));

            $baby->setHeureFin($timeF);
            $baby->setHeureDeb($timeD);

            $date=new \DateTime($request->get("date"));
            $baby->setDate($date);

            $baby->setAdresse($request->get("adresse"));
            $baby->setNbrEnfants($request->get("nbr"));
            $baby->setDescription($request->get("description"));
            $user=$this->container->get('security.token_storage')->getToken()->getUser();
            $baby->setBabysitteur($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($baby);
            $em->flush();
            return $this->redirectToRoute("lister_mes_babysittings");
        }
        return $this->render('BabysittingBundle:Babysitting/front:ajouter_babysitting.html.twig');

        /*$baby = new Babysitting();
        $form = $this->createForm(BabysittingType::class, $baby);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user=$this->container->get('security.token_storage')->getToken()->getUser();
            $baby->setBabysitteur($user);
            $em->persist($baby);
            $em->flush();
            return $this->redirectToRoute("lister_mes_babysittings");

        }
        return $this->render('BabysittingBundle:Babysitting:ajouter_babysitting.html.twig', array(
            "form" => $form->createView()
        ));*/
    }

    public function detailsBabysittingAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $bab = $em->getRepository('BabysittingBundle:Babysitting')->findBy(array("id" => $id));
        return $this->render('@Babysitting/Babysitting/front/details_babysitting.html.twig', array('bab' => $bab
        ));
    }
    function supprimerBabysittingAction($id){

        $em=$this->getDoctrine()->getManager();
        $bab=$em->getRepository("BabysittingBundle:Babysitting")->find($id);
        $em->remove($bab);
        $em->flush();
        return $this->redirectToRoute("lister_mes_babysittings");
    }

    public function modifierBabysittingAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $bab = $em->getRepository('BabysittingBundle:Babysitting')->find($request->get('id'));
        $titre=$bab->getTitre();
        $id=$bab->getId();
        $form = $this->createForm(BabysittingType::class,$bab);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($bab);
            $em->flush();
            $id=$bab->getId();
            return $this->redirectToRoute('details_babysitting',array(
                'id'=>$id,
            ));
        }
        return $this->render('@Babysitting/Babysitting/front/modifier_babysitting.html.twig', array(
            'f' => $form->createView(),'id'=>$id,
            'tit'=>$titre));

    }

    public function listerMesBabysittingsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $bab = $em->getRepository("BabysittingBundle:Babysitting")->MesBabysittings($user->getId());
        return $this->render('@Babysitting/Babysitting/front/lister_mes_babysittings.html.twig', array("bab" => $bab));

    }

    public function listerDesBabysittingsAction()
    {
        return $this->render('BabysittingBundle:Babysitting/front:lister_des_babysittings.html.twig', array(// ...
        ));
    }

    public function historiqueBabysittingAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $bab = $em->getRepository("BabysittingBundle:Babysitting")->MesAnciensBabysittings($user->getId());
        return $this->render('BabysittingBundle:Babysitting/front:historique_babysitting.html.twig', array(
            "b"=>$bab
        ));
    }

    public function chercherBabysittingAction()
    {
        return $this->render('BabysittingBundle:Babysitting/front:chercher_babysitting.html.twig', array(// ...
        ));
    }

    public function distanceBabysittingAction()
    {
        return $this->render('BabysittingBundle:Babysitting/front:distance_babysitting.html.twig', array(// ...
        ));
    }

    public function listBabysittingsAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder = $em->getRepository('BabysittingBundle:Babysitting')->createQueryBuilder('bp1');
            $queryBuilder->where('bp1.nom like :nom')->setParameter('nom', '%' . $request->query->getAlnum('filter') . '%');
            $query = $queryBuilder->getQuery();
        } else {
            $dql = "Select b from BabysittingBundle:Babysitting b";
            $query = $em->createQuery($dql);
        }
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );
        return $this->render('@Babysitting/Babysitting/admin/list_babysittings_admin.html.twig', array("babysitteur" => $result));
    }

    public function listBabysittersAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder = $em->getRepository('FrontBundle:User')->createQueryBuilder('bp1');
            $queryBuilder->where('bp1.ville like :ville')->setParameter('ville', '%' . $request->query->getAlnum('filter') . '%');
            $query = $queryBuilder->getQuery();
        } else {
            $dql = "Select b from FrontBundle:User b where b.babysitter=1";
            $query = $em->createQuery($dql);
        }
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );
        return $this->render('@Babysitting/Babysitting/admin/list_babysitters_admin.html.twig', array("babysitteur" => $result));
    }
}
