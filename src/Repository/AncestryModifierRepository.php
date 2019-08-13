<?php

namespace App\Repository;

use App\Entity\AncestryModifier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AncestryModifier|null find($id, $lockMode = null, $lockVersion = null)
 * @method AncestryModifier|null findOneBy(array $criteria, array $orderBy = null)
 * @method AncestryModifier[]    findAll()
 * @method AncestryModifier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AncestryModifierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AncestryModifier::class);
    }
}
