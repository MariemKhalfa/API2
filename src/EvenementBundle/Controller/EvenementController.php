<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use EvenementBundle\Form\EvenementType;
use EvenementBundle\Form\EvenementUpdateType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * Evenement controller.
 *
 */
class EvenementController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     */
    function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder = $em->getRepository('EvenementBundle:Evenement')->createQueryBuilder('bp1');
            $queryBuilder->where('bp1.intitule like :intitule')->setParameter('intitule', '%' . $request->query->getAlnum('filter') . '%');
            $query = $queryBuilder->getQuery();
        } else {
            $dql = "Select e from EvenementBundle:Evenement e";
            $query = $em->createQuery($dql);
        }
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );
        return $this->render('EvenementBundle::list.html.twig', array("evenement" => $result));
    }

    /**
     * Creates a new evenement entity.
     *
     */
    public function ajoutAction(Request $request)
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isValid()) {

            echo 'jj';
            /**
             * Get image
             * @var UploadedFile $file
             * @Assert\File(maxSize="2M")
             */
            $file = $evenement->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $evenement->setImage($fileName);
            $evenement->setAdresse('sfax');

            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();
        }
        return $this->render('EvenementBundle::ajout.html.twig', array(
            'form' => $form->createView()));
    }


    function UpdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('EvenementBundle:Evenement')->find($request->get('id'));
        echo $evenement->getIntitule();
        $Form = $this->createForm(EvenementUpdateType::class, $evenement);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $file = $evenement->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $evenement->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();
            return $this->redirectToRoute('evenement_list');
        }
        return $this->render('EvenementBundle::modifier.html.twig', array('form' => $Form->createView()));


    }

    function DeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('EvenementBundle:Evenement')->find($request->get('id'));
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute("evenement_list");

    }

    function listFrontAction(Request $request)
    {
        $evenement = $this->getDoctrine()->getRepository('EvenementBundle:Evenement')->findAll();
        return $this->render('EvenementBundle::parentsFront.html.twig', ['evenement' => $evenement]);


    }


    function listeAction(Request $request)
    {



        $evenement=$this->getDoctrine()->getRepository('EvenementBundle:Evenement')->findAll();

        $em = $this->getDoctrine()->getManager();



        $array = array();
        foreach ($evenement as $e) {
            $date = $e->getDate()->format('Y-m-d');


            array_push($array,array(
                "id" => $e->getId(),
                "description" => $e->getDescription(),
                "date" =>$date,
                "adresse" => $e->getAdresse(),
                "budget" => $e->getBudget(),
                "nbParticipants" => $e->getNbParticipants(),
                "categorie" => $e->getCategorie(),
                "intitule" => $e->getIntitule(),
                "image"=>$e->getImage(),



            ));
        }
        $serializer = new Serializer([new ObjectNormalizer()]);

        $jsonContent = $serializer->normalize($array);
        return new \Symfony\Component\HttpFoundation\Response(json_encode($jsonContent));

    }

    public function searchAction(Request $request)
    {
        $evenement= new Evenement();
        $content =$request->getContent();

        $em = $this->getDoctrine()->getManager();
        $event= $em->getRepository('EvenementBundle:Evenement')->findEvenement($request->get('key'));

        $serializer = new Serializer([new ObjectNormalizer()]);
        $jsonContent = $serializer->normalize($event);
        return new \Symfony\Component\HttpFoundation\Response(json_encode($jsonContent));


    }
    public function addMAction(Request $request )
    {
        $em=$this->getDoctrine()->getManager();
        $evenement=new Evenement();
        $evenement->setIntitule($request->get('intitule'));
        $evenement->setDescription($request->get('description'));
        $evenement->setAdresse($request->get('adresse'));
        $evenement->setNbParticipants($request->get('nbParticipants'));
        $evenement->setBudget($request->get('budget'));
        $evenement->setCategorie($request->get('categorie'));
        $date= new \DateTime($request->get("date"));
        $evenement->setDate($date);


        $em->persist($evenement);
        $em->flush();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($evenement);
        return new JsonResponse($formatted);
    }






}
