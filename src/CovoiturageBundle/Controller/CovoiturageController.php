<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Covoiturage;
use CovoiturageBundle\Form\CovoiturageType;
use CovoiturageBundle\Form\CovoiturageMType;
use FrontBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class CovoiturageController extends Controller
{
    public function ajouterCovAction(Request $request)
    {
        $cov = new Covoiturage();
        $form = $this->createForm(CovoiturageType::class, $cov);
        if ( $request->isMethod('post')  ) {

            $em = $this->getDoctrine()->getManager();

            $date=new \DateTime($request->get("date"));
            $cov->setDate($date);

            $d = $request->get("lieuDep");
            $s = $request->get("lieuDest");

            $cov->setLieuDep($d);
            $cov->setLieuDest($s);

            $cov->setTitre($d . ' vers ' . $s);

            $time=new \DateTime($request->get("heureDep"));
            $cov->setHeureDep($time);

            $cov->setNbPlaces($request->get("nbr"));
            $cov->setDescription($request->get("description"));

            $user = $this->container->get('security.token_storage')->getToken()->getUser(); // $user is filled with the logged user
            $cov->setCovoitureur($user);
            $voiture = $em->getRepository("CovoiturageBundle:Voiture")->findOneBy(array('proprio' => $user->getId()));
            $cov->setVoiture($voiture);

            $em->persist($cov);
            $em->flush();
            return $this->redirectToRoute("lister_mes_cov");
        }
        return $this->render('@Covoiturage/Covoiturage/front/ajouter_cov.html.twig');
    }

    function supprimerCovAction($id){

        $em=$this->getDoctrine()->getManager();
        $cov=$em->getRepository("CovoiturageBundle:Covoiturage")->find($id);
        $em->remove($cov);
        $em->flush();
        return $this->redirectToRoute("lister_mes_cov");
    }
    public function modifierCovAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cov = $em->getRepository('CovoiturageBundle:Covoiturage')->find($request->get('id'));
        $titre=$cov->getTitre();
        $form = $this->createForm(CovoiturageMType::class,$cov);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($cov);
            $em->flush();
            $id=$cov->getId();
            return $this->redirectToRoute('details_cov',array(
                'id'=>$id,
            ));
        }
        return $this->render('@Covoiturage/Covoiturage/front/modifier_cov.html.twig', array(
            'form' => $form->createView(),
            'tit'=>$titre));
    }

    public function listerMesCovAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $covs = $em->getRepository("CovoiturageBundle:Covoiturage")->MesCovoiturages($user->getId());
        return $this->render('@Covoiturage/Covoiturage/front/lister_mes_cov.html.twig', array("covs" => $covs));
    }

    public function listerDesCovAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $covs = $em->getRepository("CovoiturageBundle:Covoiturage")->CovoituragesPotentiels($user->getId(),$user->getVille());
        return $this->render('@Covoiturage/Covoiturage/front/lister_des_cov.html.twig', array("covs" => $covs));
    }
    public function detailsCovAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $cov=$em->getRepository('CovoiturageBundle:Covoiturage')->findBy(array("id"=>$id));
        /*   $cov=$em->getRepository('CovoiturageBundle:Covoiturage')->find($request->get($id));*/
        return $this->render('@Covoiturage/Covoiturage/front/details_cov.html.twig',array(
            'cov'=>$cov,
        ));
    }
    public function reserverCovAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $cov=$em->getRepository('CovoiturageBundle:Covoiturage')->findBy(array("id"=>$id));
        $covoitureuN=$cov->getCovoitureur();
        return $this->render('@Covoiturage/Covoiturage/front/reserver_cov.html.twig', array(
            'cov'=>$cov,
            'covoitureuN'=>$covoitureuN
        ));
    }

    public function historiqueCovAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $covs = $em->getRepository("CovoiturageBundle:Covoiturage")->MesAnciensCovoiturages($user->getId());

        return $this->render('@Covoiturage/Covoiturage/front/historique_cov.html.twig', array(
            "covs" => $covs
        ));
    }

    public function chercherCovAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $covs=new Covoiturage();
        if ( $request->isMethod('post')  ) {
            $lieuDep=$request->get("lieuDep");
            $covs = $em->getRepository("CovoiturageBundle:Covoiturage")->rechercheAvancee($lieuDep);
            return $this->render('@Covoiturage/Covoiturage/front/chercher_cov.html.twig', array(
                "cov" => $covs
            ));}
        return $this->render("@Covoiturage/Covoiturage/front/chercher_cov.html.twig",array ( "cov" => $covs));
    }

    public function matchingCovAction()
    {
        return $this->render('@Covoiturage/Covoiturage/front/matching_cov.html.twig', array(// ...
        ));
    }

    public function distanceCovAction()
    {
        return $this->render('@Covoiturage/Covoiturage/front/distance_cov.html.twig', array(// ...
        ));
    }
    public function listCovAdminAction(Request $request){

        /* $em = $this->getDoctrine()->getManager();

         $covoitureur = $em->getRepository("CovoiturageBundle:Covoiturage")->findCovoiturages();
         return $this->render('@Covoiturage/Covoiturage/list_cov_admin.html.twig', array("covs" => $covoitureur));*/

        $em = $this->getDoctrine()->getManager();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder = $em->getRepository('CovoiturageBundle:Covoiturage')->createQueryBuilder('bp1');
            $queryBuilder->where('bp1.nom like :nom')->setParameter('nom', '%' . $request->query->getAlnum('filter') . '%');
            $query = $queryBuilder->getQuery();
        } else {
            $dql = "Select c from CovoiturageBundle:Covoiturage c";
            $query = $em->createQuery($dql);
        }
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );
        return $this->render('@Covoiturage/Covoiturage/admin/list_cov_admin.html.twig', array("covoitureur" => $result));
    }

    public function listCovoitureursAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder = $em->getRepository('FrontBundle:User')->createQueryBuilder('bp1');
            $queryBuilder->where('bp1.ville like :ville')->setParameter('ville', '%' . $request->query->getAlnum('filter') . '%');
            $query = $queryBuilder->getQuery();
        } else {
            $dql = "Select b from FrontBundle:User b where b.covoiturage=1";
            $query = $em->createQuery($dql);
        }
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );
        return $this->render('@Covoiturage/Covoiturage/admin/list_cov_admin.html.twig', array("covoitureur" => $result));
    }

    public function pdfAction(Covoiturage $cov)
    {

        $snappy = $this->get('knp_snappy.pdf');
        $snappy->setOption('no-outline', true);
        $snappy->setOption('page-size','LETTER');
        $snappy->setOption('encoding', 'UTF-8');
        $html = $this->renderView('@Covoiturage/Covoiturage/front/reserver_cov.html.twig', array('cov' =>$cov

        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }
}
