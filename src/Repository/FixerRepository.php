<?php

namespace App\Repository;

use App\Entity\Fixer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fixer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fixer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fixer[]    findAll()
 * @method Fixer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FixerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fixer::class);
    }

    public function findAllSortedByName()
    {
        return $this->findBy([], ['name' => 'ASC']);
    }
}
