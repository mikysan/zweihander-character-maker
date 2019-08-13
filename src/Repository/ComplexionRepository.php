<?php

namespace App\Repository;

use App\Entity\Complexion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Complexion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Complexion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Complexion      findByRoll(?int &$roll = null)
 * @method Complexion[]    findAll()
 * @method Complexion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComplexionRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Complexion::class);
    }
}
