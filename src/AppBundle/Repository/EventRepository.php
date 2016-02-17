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
    public function findAll()
    {
        return parent::findBy(['enabled' => true]);
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        if (!isset($criteria['enabled'])){
            $criteria['enabled'] = true;
        }
        return parent::findBy($criteria, $orderBy, $limit, $offset); // TODO: Change the autogenerated stub
    }

    public function findEvent($dateStart,$dateEnd, array $params = [], $returnArray = false){
//        dump($dateStart);
//        dump($dateEnd);
//        exit;
        $qb = $this->createQueryBuilder('e');
        if ($returnArray === true){
            $qb->select('e.id , e.type, e.title, e.start, e.end');
        }else{
            $qb->select('e');
        }
        $qb->where('e.end >= :dateStart')
            ->andWhere('e.start <= :dateEnd')
            ->setParameters([
                'dateStart' => $dateStart,
                'dateEnd' => $dateEnd
            ])
            ->orderBy('e.start');

//        $result = $qb->getQuery()->getSQL();
//        echo  $result;
//        exit;
        $result = $qb->getQuery()->getResult();

        return $result;
    }
}
