<?php

namespace App\Repository;

use App\Entity\ActionsLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ActionsLog>
 * @method ActionsLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActionsLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActionsLog[]    findAll()
 * @method ActionsLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActionLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActionsLog::class);
    }

    public function add(ActionsLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ActionsLog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
