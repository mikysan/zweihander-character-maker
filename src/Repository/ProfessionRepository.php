<?php

namespace App\Repository;

use App\Entity\Archetype;
use App\Entity\Profession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Profession|null find($id, $lockMode = null, $lockVersion = null)
 * @method Profession|null findOneBy(array $criteria, array $orderBy = null)
 * @method Profession[]    findAll()
 * @method Profession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Profession::class);
    }

    /**
     * @param Archetype $archetype
     * @param int|null  $roll
     *
     * @return Profession
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findByRoll(Archetype $archetype, ?int &$roll = null)
    {
        $qb = $this->findByRollQb($roll);

        return $qb
            ->andWhere($qb->expr()->eq('q.archetype', ':archetype'))
            ->setParameter('archetype', $archetype)
            ->getQuery()
            ->getSingleResult();
    }
}
