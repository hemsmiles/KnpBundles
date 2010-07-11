<?php

namespace Application\S2bBundle\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{

    public function findOneByName($name)
    {
        try {
            return $this->createQueryBuilder('u')
                ->where('u.name = :name')
                ->setParameter('name', $name)
                ->getQuery()
                ->getSingleResult();
        }
        catch(NoResultException $e) {
            return null;
        }
    }

    public function findOneByNameWithBundles($name)
    {
        try {
            return $this->createQueryBuilder('u')
                ->leftJoin('u.bundles', 'b')
                ->leftJoin('u.contributionBundles', 'cb')
                ->where('u.name = :name')
                ->setParameter('name', $name)
                ->getQuery()
                ->getSingleResult();
        }
        catch(NoResultException $e) {
            return null;
        }
    }

    public function findAllSortedBy($field, $nb = null)
    {
        $qb = $this->createQueryBuilder('u');
        $qb->orderBy('u.'.$field, 'name' === $field ? 'asc' : 'desc');
        $query = $qb->getQuery();
        if(null !== $nb) {
            $query->setMaxResults($nb);
        }

        return $query->execute();
    }
}
