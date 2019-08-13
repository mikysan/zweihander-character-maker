<?php

namespace App\Repository;

use App\Entity\AgeGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AgeGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgeGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgeGroup findByRoll(?int &$roll = null)
 * @method AgeGroup[]    findAll()
 * @method AgeGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgeGroupRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AgeGroup::class);
    }
}
