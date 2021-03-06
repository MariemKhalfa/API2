<?php

namespace FrontBundle\Controller;

use FrontBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');
    }
    public function contactUsAction()
    {
        return $this->render('FrontBundle:Default:contact.html.twig');
    }
    public function aboutUsAction()
    {
        return $this->render('FrontBundle:Default:aboutUs.html.twig');
    }
    public function registerAction()
    {
        return $this->render('@Front/register.html.twig');
    }
    public function loginMobileAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("FrontBundle:User")->findOneBy(['username' =>$request->get('username')]);
        if($user){
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $salt = $user->getSalt();
            if($encoder->isPasswordValid($user->getPassword(),$request->get('password'), $salt)||$user->getPassword()==$request->get('password')){
                $serializer=new Serializer([new ObjectNormalizer()]);
                $formatted=$serializer->normalize($user);
                return new JsonResponse($formatted);
            }
        }
        return new JsonResponse("Failed");
    }

public function register1Action(Request $request){
    $em=$this->getDoctrine()->getManager();
    $user=new User();
    $user->setNom($request->get('nom'));
    $user->setPrenom($request->get('prenom'));
    /*$user->setAdresse($request->get('adresse'));
    $date=new \DateTime($request->get('date_naissance'));
    $user->setDateNaissance($date);*/
    $user->setTelephone($request->get('tel'));
    $user->setVille($request->get('ville'));
    $user->setEmail($request->get('mail'));
    $user->setPassword($request->get('mdp'));
    $user->setUsername($request->get('login'));
    $user->setRoles(array($request->get('roles'),));
    $em->persist($user);
    $em->flush();
    return new JsonResponse("Success");
}


}
