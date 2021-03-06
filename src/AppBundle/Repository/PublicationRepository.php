<?php

namespace AppBundle\Repository;

/**
 * PublicationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PublicationRepository extends \Doctrine\ORM\EntityRepository
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

    public function search($search){
        $qb = $this->createQueryBuilder('p');
        $qb->select('p');
        $qb->where("p.title LIKE '%$search%'");
        $qb->orWhere("p.body LIKE '%$search%'");
        $qb->orWhere("p.anons LIKE '%$search%'");
        $qb->orderBy('p.id', 'DESC');

        $result = $qb->getQuery()->getResult();

        return $result;
    }


}
