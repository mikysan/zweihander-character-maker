<?php

namespace App\Repository;

use App\Entity\ChaosAlignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ChaosAlignment|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method ChaosAlignment|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method ChaosAlignment      findByRoll(?int &$roll = null)
 * @method ChaosAlignment[]    findAll()
 * @method ChaosAlignment[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class ChaosAlignmentRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ChaosAlignment::class);
    }
}
