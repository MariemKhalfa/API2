<?php
/**
 * Created by PhpStorm.
 * User: botbot
 * Date: 06/04/2018
 * Time: 17:46
 */

namespace MedecinBundle\Repository;


class MedecinRepository extends \Doctrine\ORM\EntityRepository
{
    function findSerieDQL($serie){
        $query=$this->getEntityManager()->createQuery("select v from MedecinBundle:Medecins v 
where v.adresse like :serie
")->setParameter('serie','%'.$serie.'%');
        return $query->getResult();
    }
    function UpdateRating($rate,$id){
        $query=$this->getEntityManager()->createQuery("Update GarderieBundle:Garderies v 
set v.rating=v.rating+:rate where v.id=:id
")->setParameter('rate',$rate)->setParameter('id',$id);
        return $query->getResult();
    }
    function findSerieDQL5($serie,$nom){
        $query=$this->getEntityManager()->createQuery("select v from MedecinBundle:Medecins v 
where v.adresse like :serie and v.specialite like :nom
")->setParameter('serie','%'.$serie.'%')->setParameter('nom','%'.$nom.'%');
        return $query->getResult();
    }
    function findSerieDQL6($serie,$nom){
        $query=$this->getEntityManager()->createQuery("select v from GarderieBundle:Garderies v 
where v.adresse like :serie and v.nom like :nom
")->setParameter('serie','%'.$serie.'%')->setParameter('nom','%'.$nom.'%');
        return $query->getResult();
    }
    function findComment($idPub){
        $query=$this->getEntityManager()->createQuery("select v from MedecinBundle:Commentaire v 
where v.idPub=:idPub
")->setParameter('idPub',$idPub);
        return $query->getResult();
    }
    function SupprimerComment($idPub){
        $query=$this->getEntityManager()->createQuery("delete from MedecinBundle:Publication v 
where v.id=:idPub
")->setParameter('idPub',$idPub);
        return $query->getResult();
    }
    function SupprimerComment1($idPub){
        $query=$this->getEntityManager()->createQuery("delete from MedecinBundle:Commentaire v 
where v.idPub=:idPub
")->setParameter('idPub',$idPub);
        return $query->getResult();
    }
    public function Update2($serie)
    {

        $query=$this->getEntityManager()->createQuery
        ("Update GarderieBundle:Garderies g set g.nbInscriptions=g.nbInscriptions - 1
where g.id =:serie")->setParameter('serie',$serie);
        return $query->getResult();
    }

}