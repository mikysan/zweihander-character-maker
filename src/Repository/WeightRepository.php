<?php

namespace App\Repository;

use App\Entity\Ancestry;
use App\Entity\BuildType;
use App\Entity\Weight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Weight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Weight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Weight[]    findAll()
 * @method Weight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeightRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Weight::class);
    }

    /**
     * @param string $sex
     * @param Ancestry $ancestry
     * @param BuildType $buildType
     * @param int|null $roll
     *
     * @return Weight
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findByRoll(string $sex, Ancestry $ancestry, BuildType $buildType, ?int &$roll = NULL)
    {
        $qb = $this->findByRollQb($roll);
        return $qb
            ->andWhere($qb->expr()->eq('q.ancestry', ':ancestry'))
            ->andWhere($qb->expr()->eq('q.gender', ':sex'))
            ->andWhere($qb->expr()->eq('q.buildType', ':buildType'))
            ->setParameter('ancestry', $ancestry)
            ->setParameter('buildType', $buildType)
            ->setParameter('sex', lcfirst(substr($sex, 0, 1)))
            ->getQuery()
            ->getSingleResult();
    }
}
