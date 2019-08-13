<?php

namespace App\Repository;

use App\Entity\SocialClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SocialClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialClass[]    findAll()
 * @method SocialClass      findByRoll(?int &$roll = null)
 * @method SocialClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialClassRepository extends ServiceEntityRepository
{
    use d100RollQueryTrait;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SocialClass::class);
    }
}
