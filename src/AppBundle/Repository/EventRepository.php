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

    public function getNbOfEventByMinute(){
        return $this->createQueryBuilder('e')
            ->select('e.name')
            ->addSelect('e.createdAt')
            ->groupBy('e.createdAt')
            ->getQuery()
            ->getResult();
    }
}
