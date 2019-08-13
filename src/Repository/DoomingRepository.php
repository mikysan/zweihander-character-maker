<?php

namespace App\Repository;

use App\Entity\Dooming;
use App\Entity\Season;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dooming|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dooming|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dooming[]    findAll()
 * @method Dooming[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoomingRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dooming::class);
    }

    /**
     * @param Season $season
     * @param int|null $roll
     *
     * @return Dooming
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findByRoll(Season $season, ?int &$roll = NULL)
    {
        $qb = $this->findByRollQb($roll);
        return $qb
            ->andWhere($qb->expr()->eq('q.season', ':season'))
            ->setParameter('season', $season)
            ->getQuery()
            ->getSingleResult();
    }
}
