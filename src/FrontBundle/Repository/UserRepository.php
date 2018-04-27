<?php
/**
 * Created by PhpStorm.
 * User: Sofien
 * Date: 28/03/2018
 * Time: 22:30
 */

namespace FrontBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
 public function findRoleEnseignant(){
     $query = $this->getEntityManager()
         ->createQuery(" select u from FrontBundle:User u WHERE u.roles LIKE '%ROLE_ENSEIGNANT%'  ");
     return $query->getResult();
 }
    public function SelectPropGarderie()
    {
        $qb = $this->createQueryBuilder('u');

        $qb->where('u.roles LIKE :role')
            ->setParameter('role', '%"ROLE_GARDERIE"%');
        return $qb;
    }
    public function SelectBabysitter()
    {
        $query = $this->getEntityManager()
            ->createQuery(" select u from FrontBundle:User u WHERE u.babysitter=:1 ");
        return $query->getResult();
    }

    public function SelectCovoitureur()
    {
        $query = $this->getEntityManager()
            ->createQuery(" select u from FrontBundle:User u WHERE u.covoiturage=:1 ");
        return $query->getResult();
    }
}