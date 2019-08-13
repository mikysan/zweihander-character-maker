<?php

namespace App\Repository;

use App\Entity\Drawback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Drawback|null find($id, $lockMode = null, $lockVersion = null)
 * @method Drawback|null findOneBy(array $criteria, array $orderBy = null)
 * @method Drawback      findByRoll(?int &$roll = null)
 * @method Drawback[]    findAll()
 * @method Drawback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrawbackRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Drawback::class);
    }
}
