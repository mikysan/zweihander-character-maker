<?php

namespace App\Repository;

use App\Entity\AncestralTrait;
use App\Entity\Ancestry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AncestralTrait|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method AncestralTrait|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method AncestralTrait[]    findAll()
 * @method AncestralTrait[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class AncestralTraitRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AncestralTrait::class);
    }

    /**
     * @param Ancestry $ancestry
     * @param int|null $roll
     *
     * @return AncestralTrait
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findByRoll(Ancestry $ancestry, ?int &$roll = null)
    {
        $qb = $this->findByRollQb($roll);

        return $qb
            ->andWhere($qb->expr()->eq('q.ancestry', ':ancestry'))
            ->setParameter('ancestry', $ancestry)
            ->getQuery()
            ->getSingleResult();
    }
}
