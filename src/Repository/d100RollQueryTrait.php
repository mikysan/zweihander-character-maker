<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;

/**
 * Class d100RollQueryTrait
 * @package App\Repository
 */
trait d100RollQueryTrait
{
    /**
     * @param int|null $roll
     * @return mixed
     *
     * note this is intended to explode if get more than one result or no-result
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByRoll(?int &$roll = null)
    {
        return $this->findByRollQb($roll)->getQuery()->getSingleResult();
    }

    public function findByRollQb(?int &$roll = null)
    {
        $roll = $roll ?: mt_rand(1, 100);
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('q');
        $qb
            ->andWhere($qb->expr()->lte('q.minRoll', ':roll'))
            ->andWhere($qb->expr()->gte('q.maxRoll', ':roll'))
            ->setParameter('roll', $roll);

        return $qb;
    }
}
