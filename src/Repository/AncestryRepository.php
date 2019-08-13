<?php

namespace App\Repository;

use App\Entity\Ancestry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ancestry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ancestry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ancestry findByRoll(?int &$roll = null)
 * @method Ancestry[]    findAll()
 * @method Ancestry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AncestryRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ancestry::class);
    }
}
