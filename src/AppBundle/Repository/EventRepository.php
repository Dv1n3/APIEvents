<?php

namespace AppBundle\Repository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends \Doctrine\ORM\EntityRepository
{
    public function getNbOfEventByName(){

        return $this->createQueryBuilder('e')
            ->select('e.name')
            ->addselect('count(e) as occurence')
            ->groupBy('e.name')
            ->getQuery()
            ->getResult();
    }

    public function getNbOfEventByCreationDate(){
        return $this->createQueryBuilder('e')
            ->select('e.name')
            ->addSelect('e.createdAt')
            ->orderBy('e.createdAt')
            ->getQuery()
            ->getResult();
    }
}
