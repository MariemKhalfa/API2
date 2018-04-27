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
where v.adresse like :serie and v.nom like :nom
")->setParameter('serie','%'.$serie.'%')->setParameter('nom','%'.$nom.'%');
        return $query->getResult();
    }

}