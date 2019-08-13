<?php

namespace App\Repository;

use App\Entity\Archetype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Archetype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Archetype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Archetype findByRoll(?int &$roll = null)
 * @method Archetype[]    findAll()
 * @method Archetype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchetypeRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Archetype::class);
    }
}
