<?php

namespace App\Repository;

use App\Entity\Ancestry;
use App\Entity\Height;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Height|null find($id, $lockMode = null, $lockVersion = null)
 * @method Height|null findOneBy(array $criteria, array $orderBy = null)
 * @method Height[]    findAll()
 * @method Height[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeightRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Height::class);
    }

    /**
     * @param string $sex
     * @param Ancestry $ancestry
     * @param int|null $roll
     *
     * @return Height
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findByRoll(string $sex, Ancestry $ancestry, ?int &$roll = NULL)
    {
        $qb = $this->findByRollQb($roll);
        return $qb
            ->andWhere($qb->expr()->eq('q.ancestry', ':ancestry'))
            ->andWhere($qb->expr()->eq('q.gender', ':sex'))
            ->setParameter('ancestry', $ancestry)
            ->setParameter('sex', lcfirst(substr($sex, 0, 1)))
            ->getQuery()
            ->getSingleResult();
    }
}
