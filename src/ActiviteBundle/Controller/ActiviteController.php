<?php

namespace ActiviteBundle\Controller;

use ActiviteBundle\Form\ActiviteUpdateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ActiviteBundle\Entity\Activite;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ActiviteController extends Controller
{


    /**
     * @Route("/activite/view", name="view_activite_route")
     */
    public function viewActiviteAction()
    {
        $activites=$this->getDoctrine()->getRepository('ActiviteBundle:Activite')->findAll();

        return $this->render('@Activite/pages/index.html.twig', ['activites'=>$activites]);
    }


    /**
     * @Route("/activite/create", name="create_activite_route")
     */
    public function createActiviteAction(Request $request)
    {

        $activite = new Activite();
        $form=$this->createFormBuilder($activite)
        ->add ('type',TextType::class,array('attr' => array('class'=>'form-control')))
        ->add('adresse',TextType::class,array('attr' => array('class'=>'form-control')))

        ->add('date', DateType::class, array('attr' => 'single_text',

            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker'],
        ))
            ->add('description', TextareaType::class, array('label'=>'Ajouter une description'))
        ->add('heure',TimeType::class,array('attr' => array('class'=>'form-control')))
        ->add('agemin', NumberType::class,array('attr' => array('class'=>'form-control')))
            ->add('image', FileType::class, array('label' => "insérez une image"))
        ->add('save',SubmitType::Class,array('label'=>'Créer Activité', 'attr' =>array ('class'=>'btn btn-warning',
            'style'=>'margin-top:10px')))
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $type=$form['type']->getData();
                $image=$form['image']->getData();
                $description=$form['description']->getData();
                $adresse=$form['adresse']->getData();
                $date=$form['date']->getData();
                $heure=$form['heure']->getData();
                $agemin=$form['agemin']->getData();
                $image=$form['image']->getData();
                $description=$form['description']->getData();



                $activite->setType($type);
                $activite->setDescription($description);
                $activite->setImage($image);
                $activite->setAdresse($adresse);
                $activite->setDate($date);
                $activite->setHeure($heure);
                $activite->setAgeMin($agemin);
            /**
             * Get image
             * @var UploadedFile $file
             */
            $file=$activite->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $activite->setImage($fileName);

                $em =$this->getDoctrine()->getManager();
                $em->persist($activite);
                $em->flush();
                $this->addFlash('message','Activité enregistrée avec succès');
                return $this->redirectToRoute('activite_afficherActivite');
        }



return $this->render("@Activite/pages/create.html.twig",['form' =>$form->createView()]);

    }


    /**
     * @Route("/activite/update/{id}", name="update_activite_route")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateActiviteAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $activite=$em->getRepository('ActiviteBundle:Activite')->find($request->get('id'));
        $Form=$this->createForm(ActiviteUpdateType::class,$activite);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $file=$activite->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $activite->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($activite);
            $em->flush();
            $this->addFlash('message','Activité modifiée avec succès');
            return $this->redirectToRoute('activite_afficherActivite');

        }
        return $this->render('ActiviteBundle:pages:ModificationActivite.html.twig', array('form'=>$Form->createView()));
    }


    /**
     * @Route("/activite/show/{id}", name="show_activite_route")
     */
    public function showActiviteAction(Request $request,$id)
    {
        $activite=$this->getDoctrine()->getRepository('ActiviteBundle:Activite')->find($id);
        return $this->render('pages/view.html.twig',['activite'=>$activite]) ;
    }


    /**
     * @Route("/activite/delete/{id}", name="delete_activite_route")
     */
    public function deleteActiviteAction( Request $request, $id )
    {
        $em=$this->getDoctrine()->getManager();
        $activite=$em->getRepository('ActiviteBundle:Activite')->find($id);
        $em->remove($activite);

        $em->flush();
        $this->addFlash('message','Activité supprimée avec succès');

        return $this->redirectToRoute('activite_afficherActivite');
    }

    public function afficheBackAction()
    {
        $em = $this->getDoctrine();
        $Activite = $em->getRepository("ActiviteBundle:Activite")->findAll();
        return $this->render("ActiviteBundle:pages:AfficherBackActivite.html.twig", array("Activite" => $Activite));
    }

    function listFrontAction(Request $request)
    {
        $activite=$this->getDoctrine()->getRepository('ActiviteBundle:Activite')->findAll();
        return $this->render('ActiviteBundle:pages:AfficherFrontActivite.html.twig',['activite'=>$activite]) ;

    }

    function  ActiviteDetailsAction(Request $request){

        $voitures=new Activite();
        $em=$this->getDoctrine()->getManager();
        $activite=$em->getRepository('ActiviteBundle:Activite')->findAll();

        if($request->isXmlHttpRequest()){
            $serializer=new Serializer(array(new ObjectNormalizer()));
            $serie=$voiture->getDescription();
            $voitures=$em->getRepository('ActiviteBundle:Activite')->findOneBy(array('description'=>$serie));
            $data=$serializer->normalize($voitures);
            return new JsonResponse($data);
        }//
        return $this->render('ActiviteBundle:pages:ActiviteDetails.html.twig',array("modele"=>$activite,"activite"=>$voitures));
    }

}
