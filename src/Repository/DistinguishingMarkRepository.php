<?php

namespace App\Repository;

use App\Entity\DistinguishingMark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DistinguishingMark|null find($id, $lockMode = null, $lockVersion = null)
 * @method DistinguishingMark|null findOneBy(array $criteria, array $orderBy = null)
 * @method DistinguishingMark      findByRoll(?int &$roll = null)
 * @method DistinguishingMark[]    findAll()
 * @method DistinguishingMark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DistinguishingMarkRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DistinguishingMark::class);
    }
}
