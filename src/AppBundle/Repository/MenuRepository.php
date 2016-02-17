<?php

namespace AppBundle\Repository;

/**
 * MenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MenuRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAll()
    {
        return parent::findBy(['enabled' => true],['sort' => 'ASC']);
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        if (!isset($criteria['enabled'])){
            $criteria['enabled'] = true;
        }
        $orderBy['sort'] = 'ASC';
        return parent::findBy($criteria, $orderBy, $limit, $offset); // TODO: Change the autogenerated stub
    }
}
