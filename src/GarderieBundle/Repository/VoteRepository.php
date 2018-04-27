<?php
/**
 * Created by PhpStorm.
 * User: botbot
 * Date: 06/04/2018
 * Time: 17:46
 */

namespace GarderieBundle\Repository;


class VoteRepository extends \Doctrine\ORM\EntityRepository
{
    public function RemoveVote($id)
    {

        $query=$this->getEntityManager()->createQuery("Delete from GarderieBundle:Vote v where v.idgarderie =:id")->setParameter('id',$id);
        return $query->getResult();
    }
    public function RemoveInsc($id)
    {

        $query=$this->getEntityManager()->createQuery("Delete from GarderieBundle:Inscription v where v.idGarderie =:id")->setParameter('id',$id);
        return $query->getResult();
    }
    public function RemoveDemande($id)
    {

        $query=$this->getEntityManager()->createQuery("Delete from GarderieBundle:Demande v where v.idGarderie =:id")->setParameter('id',$id);
        return $query->getResult();
    }
}