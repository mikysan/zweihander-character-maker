<?php

namespace App\Repository;

use App\Entity\Upbringing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Upbringing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Upbringing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Upbringing[]    findAll()
 * @method Upbringing      findByRoll(?int &$roll = null)()
 * @method Upbringing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpbringingRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Upbringing::class);
    }
}
