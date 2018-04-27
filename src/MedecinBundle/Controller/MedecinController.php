<?php

namespace MedecinBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use GarderieBundle\Entity\Garderies;
use GarderieBundle\Entity\Inscription;
use GarderieBundle\Entity\Vote;
use GarderieBundle\Form\VoteType;
use MedecinBundle\Entity\Medecins;
use MedecinBundle\Form\MedecinsType;
use MedecinBundle\Form\MedecinsUpdateType;
use MedecinBundle\Form\RechercheGarderiesType;
use MedecinBundle\Form\RechercheMedecinsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class MedecinController extends Controller
{
    function ajoutAction(Request $request){

        $medecin=new Medecins();

        $Form=$this->createForm(MedecinsType::class,$medecin);
        $Form->handleRequest($request);
        if($Form->isValid()){
            echo 'jj';
            /**
             * Get image
             * @var UploadedFile $file
             */
            $adresse=$medecin->getAdresse();
            if($adresse=='tunis')
                {
                    $medecin->setLatitude(36.81897);

                    $medecin->setLongitude(10.16579);                }
            $file=$medecin->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $medecin->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($medecin);
            $em->flush();
            //    return  $this->redirectToRoute("AffichageModele");
        }
        return $this->render('MedecinBundle:Back:ajoutMedecin.html.twig',array('form'=>$Form->createView()));
    }
    function listAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder = $em->getRepository('MedecinBundle:Medecins')->createQueryBuilder('bp1');
            $queryBuilder->where('bp1.nom like :nom')->setParameter('nom', '%' . $request->query->getAlnum('filter') . '%');
            $query=$queryBuilder->getQuery();}

        else{   //$modeles=$em->getRepository("Garderie1Bundle:Garderies")->findAll();
            $dql="Select m from MedecinBundle:Medecins m";
            $query=$em->createQuery($dql);}
        $paginator  = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2)
        );
        return $this->render('MedecinBundle:Back:listesMedecins.html.twig',array("medecin"=>$result));
    }
    function DeleteAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $medecin=$em->getRepository('MedecinBundle:Medecins')->find($request->get('id'));
        $em->remove($medecin);
        $em->flush();
        return $this->redirectToRoute("medecin_liste");

    }
    function UpdateAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $medecin=$em->getRepository('MedecinBundle:Medecins')->find($request->get('id'));
        echo $medecin->getNom();
        $Form=$this->createForm(MedecinsUpdateType::class,$medecin);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $file=$medecin->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $medecin->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($medecin);
            $em->flush();
            return $this->redirectToRoute('medecin_liste');
        }
        return $this->render('MedecinBundle:Back:ModifierMedecin.html.twig',array('form'=>$Form->createView()));


    }
    function listeDemandesAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $demande=$em->getRepository('GarderieBundle:Demande')->findAll();

        return $this->render('GarderieBundle:Back:traiterDemandes.html.twig',array("demande"=>$demande));
    }
    function AccepterDemandeAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        echo $request->get('id');
        $demande=$em->getRepository('GarderieBundle:Demande')->findOneBy(array('id'=> $request->get('id')));
        $garderie=$em->getRepository('GarderieBundle:Garderies')->findOneBy(array('id'=> $demande->getIdGarderie()));
        echo $demande->getId();

$demande->setEtat('true');
echo $garderie->getEtat();
$garderie->setEtat('true');
$em->persist($demande);


        $em->flush();
        $em->persist($garderie);
        $em->flush();
        return $this->redirectToRoute("demande_afficher2");

    }
    function DeleteDemandeAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        echo $request->get('id');
        $demande=$em->getRepository('GarderieBundle:Demande')->findOneBy(array('id'=> $request->get('id')));
        echo $demande->getId();

        $em->remove($demande);

        $em->flush();
        return $this->redirectToRoute("demande_afficher2");
    }
    function listFrontAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('GarderieBundle:Garderies')->createQueryBuilder('bp1');
        $queryBuilder->where(' bp1.etat=:id')
            ->setParameter('id','true');
        $query = $queryBuilder->getQuery();
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );
        return $this->render('GarderieBundle:Front:afficherListesGarderies.html.twig', array("garderie" => $result));

    }
    function  DetailsGarderiesAction(Request $request){
$voitures=new Garderies();
        $em=$this->getDoctrine()->getManager();
        $garderie=$em->getRepository('GarderieBundle:Garderies')->find($request->get('id'));
        $Modele=new Vote();
        $Modele->setIdGarderie($garderie);
        $Form=$this->createForm(VoteType::class,$Modele);
        $Form->handleRequest($request);
        if($Form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($Modele);
            $em->flush();
            $garderie1=$em->getRepository('GarderieBundle:Garderies')->Update($Modele->getRating(),$garderie->getId());
            //  return  $this->redirectToRoute("AffichageModele");
        }
        return $this->render('GarderieBundle:Front:GarderiesDetails.html.twig',array("modele"=>$garderie,'form'=>$Form->createView(),"garderie"=>$voitures));
    }
    function  InscriptionAction(Request $request){
        $usr=$this->get('security.token_storage')->getToken()->getUser();
        $em= $this->getDoctrine()->getManager();
        $enfant1=$em->getRepository('FrontBundle:Enfant')->findEnfants($this->getUser()->getId());

        $b=$request->get('id');
        $garderie3=$em->getRepository('GarderieBundle:Garderies')->findOneBy(array('id'=>$b));

        $inscription= new Inscription();

        if($request->isMethod('Post')){

            $a=$request->get('idenfant1');


            $enfant=$em->getRepository('FrontBundle:Enfant')->findOneBy(array('pseudonyme'=>$a));
            echo $enfant->getCin();
            $inscription->setIdenfant($enfant);
            $inscription->setEtat('attente');
            $garderie3=$em->getRepository('GarderieBundle:Garderies')->findOneBy(array('id'=>$b));
            $inscription->setIdgarderie($garderie3);
            $date=$request->get('jourArriv');
            $inscription->setJourArriv(new \DateTime("$date"));
            $inscription->setIdparent($this->getUser());
            $inscription->setCommentaires($request->get('commentaires'));
            $inscription->setNurserie($request->get('nurserie'));
            $inscription->setRepas($request->get('repas'));
            $inscription->setAdresse($request->get('adresse'));
            $inscription->setNomparent($this->getUser());
            $em->persist($inscription);
            $em->flush();
            //      return  $this->redirectToRoute("AffichageModele");
            /*  $inscription= new \Garderie1Bundle\Entity\Inscription();

              $em = $this->getDoctrine()->getManager();
              $date = $request->get('jourArriv');
             // $r=$em->getRepository('Garderie1Bundle:Inscription')->Afficher($b);
           /*   $date1= new \DateTime("$date");
              $date2=strtotime(date_format($date1,"Y/m/d H:i:s"));

              $trouve=0;
              foreach( $r as $item2 )
              {  if(strtotime($date2<date_format($item2->getDateOuverture(),"Y/m/d H:i:s")) && $date2>date_format($item2->getDateFermeture(),"Y/m/d H:i:s"))
              {
                  $trouve=1;
                  break;
              }
              }

              if($trouve==0)
              {


                  $em->persist($inscription);
                  $em->flush();
                  $a="votre rendez vous est disponible";
                  return new JsonResponse(\Symfony\Component\HttpFoundation\Response::HTTP_OK);
  */
            /*     else{
                     return new JsonResponse(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
                 }*/

            $request->getSession()
                ->getFlashBag()
                ->add('notice', 'Votre demande dinscription a étè enregistrée!')
            ;
         //   return  $this->redirectToRoute("garderie_listeFront2");
        }



        return $this->render('GarderieBundle:Front:Inscription.html.twig',array('enfant1' =>
            $enfant1,'garderie'=>$garderie3));
    }

    public function RatingGarderiesAction()
    {
        $em=$this->getDoctrine()->getManager();
        $garderies=$em->getRepository("GarderieBundle:Garderies")->First3Garderies();
        $a=new Garderies();
        $b=new Garderies();
        $c=new Garderies();




        $a=$garderies[0];
        echo $a->getRating();
        echo $a->getId();
        $b=$garderies[1];

        $c=$garderies[2];




        return $this->render('GarderieBundle:Front:MeilleursGarderies.html.twig',array("First"=>$a,"Second"=>$b,"Third"=>$c));
    }

    public function StatistiquesAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $ratings = $em->getRepository(Garderies::class)->findAll();
        $totalRating=0;
        foreach($ratings as $rating) {
            $totalRating=$totalRating+$rating->getRating();
        }
        $data= array();
        $stat=['Garderie', 'rating'];
        $nb=0;
        array_push($data,$stat);
        foreach($ratings as $rating) {
            $stat=array();
            //     array_push($stat,$rating->getNom(),(($rating->getRating()) *100)/$totalRating);
            $nb=($rating->getRating() *100)/$totalRating;
            $stat=[$rating->getNom(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Statistiques des garderies selon rating');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('pink');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $histogram = new Histogram();
        $histogram->getData()->setArrayToDataTable(
            $data
        );
        $histogram->getOptions()->setTitle('Country Populations');
        $histogram->getOptions()->setWidth(900);
        $histogram->getOptions()->setHeight(500);
        $histogram->getOptions()->getLegend()->setPosition('none');
        $histogram->getOptions()->setColors(['#e7711c']);
        $histogram->getOptions()->getHistogram()->setLastBucketPercentile(10);
        $histogram->getOptions()->getHistogram()->setBucketSize(10000000);
        return $this->render('GarderieBundle:Back:statistiques.html.twig', array('piechart' =>
            $pieChart,'histogram'=>$histogram));
    }
    function listMedecinFrontAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('MedecinBundle:Medecins')->createQueryBuilder('bp1');

        $query = $queryBuilder->getQuery();
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );
        return $this->render('@Medecin/Front/afficherListesMedecins.html.twig', array("medecin" => $result));

    }
    function  DetailsMedecinsAction(Request $request){
        $medecin=new Medecins();
        $form=$this->createForm(RechercheMedecinsType::class,$medecin);


        $em=$this->getDoctrine()->getManager();
        $garderie=$em->getRepository('MedecinBundle:Medecins')->find($request->get('id'));
        $medecins=$em->getRepository('MedecinBundle:Medecins')->findAll();
        $form->handleRequest($request);

        //     if($form->isValid()){
        if($request->isXmlHttpRequest()){
            $serializer=new Serializer(array(new ObjectNormalizer()));
            $adresse=$medecin->getAdresse();
            echo $adresse;
            $medecins=$em->getRepository('MedecinBundle:Medecins')->findSerieDQL($adresse);
            $data=$serializer->normalize($medecins);
            return new JsonResponse($data);
        }//

        return $this->render('@Medecin/Front/DetailsMedecins.html.twig',array("modele"=>$garderie,'form'=>$form->createView(),"medecin"=>$medecins));
    }

    function notifAction(Request $request){

        return $this->render('GarderieBundle:Front:notifications.html.twig');

    }
    function rechercherAction(Request $request){
        $garderie=new Garderies();
        $form=$this->createForm(\GarderieBundle\Form\RechercheGarderiesType::class,$garderie);


        $em=$this->getDoctrine()->getManager();

        $garderies=$em->getRepository('GarderieBundle:Garderies')->findAll();
        $form->handleRequest($request);

        //     if($form->isValid()){
        if($request->isXmlHttpRequest()){
            $serializer=new Serializer(array(new ObjectNormalizer()));
            $adresse=$garderie->getAdresse();
            echo $adresse;
            $medecins=$em->getRepository('GarderieBundle:Garderies')->findDQL($adresse);
            $data=$serializer->normalize($medecins);
            return new JsonResponse($data);
        }//


        return $this->render('GarderieBundle:Front:rechercherGarderie.html.twig',array('form'=>$form->createView(),"garderie"=>$garderies));

    }
    function rechercherMedecinAction(Request $request){
        $medecin=new Medecins();
        $form=$this->createForm(RechercheMedecinsType::class,$medecin);


        $em=$this->getDoctrine()->getManager();

        $medecins=$em->getRepository('MedecinBundle:Medecins')->findAll();
        $form->handleRequest($request);

        //     if($form->isValid()){
        if($request->isXmlHttpRequest()){
            $serializer=new Serializer(array(new ObjectNormalizer()));
            $adresse=$medecin->getAdresse();

            $medecins=$em->getRepository('MedecinBundle:Medecins')->findSerieDQL($adresse);
            $data=$serializer->normalize($medecins);
            return new JsonResponse($data);
        }//


        return $this->render('MedecinBundle:Front:rechercherMedecin.html.twig',array('form'=>$form->createView(),"medecin"=>$medecins));

    }
    public function allallAction(){
        $tasks=$this->getDoctrine()->getManager()->getRepository('GarderieBundle:Garderies')->findAll();
        $serializer=new
        Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $garderie=$em->getRepository('MedecinBundle:Medecins')->UpdateRating($request->get('rating'),$request->get('id'));

        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($garderie);
        return new JsonResponse($formatted);
    }

    public function new1Action(Request $request){
        $em=$this->getDoctrine()->getManager();
        $inscription=new Inscription();
        $enfant=$em->getRepository('FrontBundle:Enfant')->findOneBy(array('pseudonyme'=>$request->get('nomEnfant')));
        $inscription->setIdenfant($enfant);
        $inscription->setEtat('attente');
        $garderie3=$em->getRepository('GarderieBundle:Garderies')->findOneBy(array('id'=>$request->get('idGarderie')));
        $inscription->setIdgarderie($garderie3);
        $parent=$em->getRepository('FrontBundle:User')->findOneBy(array('id'=>$request->get('idParent')));
        $date=$request->get('date');
        $inscription->setJourArriv(new \DateTime("$date"));
        $inscription->setIdparent($parent);
        $inscription->setCommentaires($request->get('commentaires'));
        $inscription->setNurserie($request->get('nurserie'));
        $inscription->setRepas($request->get('repas'));
        $inscription->setAdresse($request->get('adresse'));
        $inscription->setNomparent($parent);
        $em->persist($inscription);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($inscription);
        return new JsonResponse($formatted);
    }

    public function allallMedecinsAction(){
        $tasks=$this->getDoctrine()->getManager()->getRepository('MedecinBundle:Medecins')->findAll();
        $serializer=new
        Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }
    function  DetailsMedecins5Action(Request $request){
        $medecin=new Medecins();
        $em=$this->getDoctrine()->getManager();
        $medecins=$em->getRepository('MedecinBundle:Medecins')->findSerieDQL5($request->get('adresse'),$request->get('nom'));
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($medecins);
        return new JsonResponse($formatted);
    }

}
