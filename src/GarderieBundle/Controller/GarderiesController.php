<?php

namespace GarderieBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use GarderieBundle\Entity\Demande;
use GarderieBundle\Entity\Garderies;
use GarderieBundle\Entity\Inscription;
use GarderieBundle\Entity\Vote;
use GarderieBundle\Form\GarderiesType;
use GarderieBundle\Form\GarderiesUpdateType;
use GarderieBundle\Form\Inscription2Type;
use GarderieBundle\Form\VoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class GarderiesController extends Controller
{
    function ajoutAction(Request $request){


        $garderie=new Garderies();
        $demande=new Demande();
        $garderie->setNbInscriptions(0);
        $demande->setEtat('false');
        $garderie->setEtat("No");
        $garderie->setLatitude(36.81897);

        $garderie->setLongitude(10.16579);
        $garderie->setRating(0);
        $Form=$this->createForm(GarderiesType::class,$garderie);
        $Form->handleRequest($request);
        if($Form->isValid()){
            /**
             * Get image
             * @var UploadedFile $file
             */
$demande->setIdGarderie($garderie);
            $file=$garderie->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $garderie->setImage($fileName);
            $date1=$garderie->getDateOuverture();
            $date2=$garderie->getDateFermeture();
            if($date1>$date2 || $date2<$date1){
                $request->getSession()
                    ->getFlashBag()
                    ->add('error', 'veuillez vérifier la date !');
            }
            else{
            $em=$this->getDoctrine()->getManager();
            $em->persist($garderie);
            $em->flush();
            $em->persist($demande);
            $em->flush();

           return  $this->redirectToRoute("garderie_liste");}
        }
        return $this->render('GarderieBundle:Back:ajoutGarderie.html.twig',array('form'=>$Form->createView()));
    }
    function listAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder = $em->getRepository('GarderieBundle:Garderies')->createQueryBuilder('bp1');
            $queryBuilder->where('bp1.nom like :nom and bp1.proprietaire=:id')->setParameter('nom', '%' . $request->query->getAlnum('filter') . '%')
                ->setParameter('id',$this->getUser()->getId());
            $query=$queryBuilder->getQuery();}

        else{   //$modeles=$em->getRepository("Garderie1Bundle:Garderies")->findAll();
            $queryBuilder = $em->getRepository('GarderieBundle:Garderies')->createQueryBuilder('bp1');
            $queryBuilder->where(' bp1.proprietaire=:id')
                ->setParameter('id',$this->getUser()->getId());
            $query=$queryBuilder->getQuery();}
        $paginator  = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2)
        );

        return $this->render('GarderieBundle:Back:listeGarderies.html.twig',array("garderie"=>$result));
    }
    function UpdateAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $garderie=$em->getRepository('GarderieBundle:Garderies')->find($request->get('id'));

        $Form=$this->createForm(GarderiesUpdateType::class,$garderie);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $file=$garderie->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $garderie->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($garderie);
            $em->flush();
            return $this->redirectToRoute('garderie_liste');
        }
        return $this->render('GarderieBundle:Back:ModifierGarderie.html.twig',array('form'=>$Form->createView()));


    }
    function DeleteAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $garderie=$em->getRepository('GarderieBundle:Garderies')->find($request->get('id'));
        $vote=$em->getRepository('GarderieBundle:Vote')->RemoveVote($garderie->getId());
        $vote1=$em->getRepository('GarderieBundle:Vote')->RemoveInsc($garderie->getId());
        $vote2=$em->getRepository('GarderieBundle:Vote')->RemoveDemande($garderie->getId());
        $em->remove($garderie);
        $em->flush();
        return $this->redirectToRoute("garderie_liste");

    }
    function listesInscriptionAction(Request $request){
        $inscription1=new Inscription();
        $em=$this->getDoctrine()->getManager();
        $inscription=$em->getRepository('GarderieBundle:Inscription')->findAll();
        $Form=$this->createForm(Inscription2Type::class,$inscription1);
        $Form->handleRequest($request);
        if($Form->isValid()){

            $inscription=$em->getRepository('GarderieBundle:Inscription')->findBy(array('idGarderie'=>$inscription1->getIdGarderie()));
        }
        return $this->render('GarderieBundle:Back:listeInscription.html.twig',array('form'=>$Form->createView(),'inscription'=>$inscription));


    }
    function ApprouverAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        echo $request->get('id');
        $inscription = $em->getRepository('GarderieBundle:Inscription')->findOneBy(array('id' => $request->get('id')));
        $garderie = $em->getRepository('GarderieBundle:Garderies')->findOneBy(array('id' => $inscription->getIdGarderie()));

        if ($garderie->getNbInscriptions() < 5) {
            $inscription->setEtat('true');

            $garderie1 = $em->getRepository('GarderieBundle:Garderies')->Update2($garderie->getId());
            $manager = $this->get('mgilet.notification');
            $notif = $manager->createNotification('Inscription!');
            $notif->setMessage('Bonjour Mr Votre demande a étè accepté');
            $notif->setLink('http://symfony.com/');
            // or the one-line method :
            // $manager->createNotification('Notification subject','Some random text','http://google.fr');

            // you can add a notification to a list of entities
            // the third parameter `$flush` allows you to directly flush the entities
            $manager->addNotification(array($this->getUser()), $notif, true);
        } else {
            $manager = $this->get('mgilet.notification');
            $notif = $manager->createNotification('Inscription !');
            $notif->setMessage('Bonjour Mr Votre demande a étè refusé');
            $notif->setLink('http://symfony.com/');
            // or the one-line method :
            // $manager->createNotification('Notification subject','Some random text','http://google.fr');

            // you can add a notification to a list of entities
            // the third parameter `$flush` allows you to directly flush the entities
            $manager->addNotification(array($this->getUser()), $notif, true);
        }


        return $this->redirectToRoute("garderie_inscriptionListe");
    }
    public function StatistiquesInscripionAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $garderies = $em->getRepository(Garderies::class)->findAll();
        $total=0;
        foreach($garderies as $garderie) {
            $total=$total+$garderie->getNbInscriptions();
        }
        $data= array();
        $stat=['Garderie', 'nbParticipants'];
        $nb=0;
        array_push($data,$stat);
        foreach($garderies as $garderie) {
            $stat=array();
            //     array_push($stat,$rating->getNom(),(($rating->getRating()) *100)/$totalRating);
            $nb=($garderie->getNbInscriptions()*100)/$total;
            $stat=[$garderie->getNom(),$nb];
            array_push($data,$stat);
        }

        $histogram = new Histogram();
        $histogram->getData()->setArrayToDataTable(
            $data
        );
        $histogram->getOptions()->setTitle('Statistiques selon le nbre des participants');
        $histogram->getOptions()->setWidth(900);
        $histogram->getOptions()->setHeight(500);
        $histogram->getOptions()->getLegend()->setPosition('none');
        $histogram->getOptions()->setColors(['#e7711c']);
        $histogram->getOptions()->getHistogram()->setLastBucketPercentile(10);
        $histogram->getOptions()->getHistogram()->setBucketSize(10000000);
        return $this->render('GarderieBundle:Back:statistiquesNbInscriptions.html.twig', array('histogram'=>$histogram));
    }


    public function allallAction(){
        $tasks=$this->getDoctrine()->getManager()->getRepository('GarderieBundle:Garderies')->findAll();
        $serializer=new
        Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    }
