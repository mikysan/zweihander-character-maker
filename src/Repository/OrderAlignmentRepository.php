<?php

namespace App\Repository;

use App\Entity\OrderAlignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrderAlignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderAlignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderAlignment[]    findAll()
 * @method OrderAlignment      findByRoll(?int &$roll = null)
 * @method OrderAlignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderAlignmentRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrderAlignment::class);
    }
}
