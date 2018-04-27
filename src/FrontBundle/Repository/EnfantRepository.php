<?php
/**
 * Created by PhpStorm.
 * User: Sofien
 * Date: 28/03/2018
 * Time: 22:30
 */

namespace FrontBundle\Repository;


use Doctrine\ORM\EntityRepository;

class EnfantRepository extends EntityRepository
{
    function findEnfants($id){
        $query=$this->getEntityManager()->createQuery("select e from FrontBundle:Enfant e where  e.cin=:id")->setParameter('id',$id);
        return $query->getResult();
    }
    public function findAllUsersByEntreprise($k)
    {

        $qb = $this->createQueryBuilder('u');

        $qb->where('u.cin=:k')
            ->setParameter('k', $k);
        echo "kkk";
        return $qb;
    }
    public function findAllUsersByEntreprise1($k)
    {

        $qb = $this->createQueryBuilder('u.cin');

        $qb->where('u.cin=:k')
            ->setParameter('k', $k);
        echo "kkk";
        return $qb->getRe;
    }

}