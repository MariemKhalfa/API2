<?php
/**
 * Created by PhpStorm.
 * User: botbot
 * Date: 06/04/2018
 * Time: 17:46
 */

namespace GarderieBundle\Repository;


class GarderieRepository extends \Doctrine\ORM\EntityRepository
{
    public function RemoveVote($id)
    {

        $query=$this->getEntityManager()->createQuery("Delete from GarderieBundle:Vote v where v.idgarderie =:id")->setParameter('id',$id);
        return $query->getResult();
    }
    public function Demande($id)
    {

        $query=$this->getEntityManager()->createQuery("Select g from GarderieBundle:Garderie g where g.idgarderie =:id")->setParameter('id',$id);
        return $query->getResult();
    }
    public function Update($k,$serie)
    {

        $query=$this->getEntityManager()->createQuery("Update GarderieBundle:Garderies g set g.rating=g.rating+:k 
where g.id =:serie")->setParameter('serie',$serie)->setParameter('k',$k);
        return $query->getResult();
    }
    public function First3Garderies()
    {

        $query=$this->getEntityManager()->createQuery("Select g from GarderieBundle:Garderies g order by g.rating DESC
");
        return $query->getResult();
    }
    function findSerieDQL($serie){
        $query=$this->getEntityManager()->createQuery("select v from MedecinBundle:Medecin v 
where v.adresse like :serie
")->setParameter('serie','%'.$serie.'%');
        return $query->getResult();
    }
    public function Update2($serie)
    {

        $query=$this->getEntityManager()->createQuery
        ("Update GarderieBundle:Garderies g set g.nbInscriptions=g.nbInscriptions + 1
where g.id =:serie")->setParameter('serie',$serie);
        return $query->getResult();
    }
    function findDQL($serie){
        $query=$this->getEntityManager()->createQuery("select v from GarderieBundle:Garderies v 
where v.adresse like :serie
")->setParameter('serie','%'.$serie.'%');
        return $query->getResult();
    }

}