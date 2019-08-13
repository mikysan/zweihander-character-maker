<?php

namespace App\Repository;

use App\Entity\Ancestry;
use App\Entity\EyeColor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EyeColor|null find($id, $lockMode = null, $lockVersion = null)
 * @method EyeColor|null findOneBy(array $criteria, array $orderBy = null)
 * @method EyeColor[]    findAll()
 * @method EyeColor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EyeColorRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EyeColor::class);
    }

    /**
     * @param Ancestry $ancestry
     * @param int|null $roll
     *
     * @return EyeColor
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findByRoll(Ancestry $ancestry, ?int &$roll = NULL)
    {
        $qb = $this->findByRollQb($roll);
        return $qb
            ->andWhere($qb->expr()->eq('q.ancestry', ':ancestry'))
            ->setParameter('ancestry', $ancestry)
            ->getQuery()
            ->getSingleResult();
    }
}
