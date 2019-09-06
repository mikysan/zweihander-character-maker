<?php

namespace App\Repository;

use App\Entity\Armor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Armor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Armor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Armor[]    findAll()
 * @method Armor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArmorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Armor::class);
    }
}
