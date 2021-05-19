<?php


namespace App\Manager;


use App\Interfaces\EntityInterface;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractEntityManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findByID(int $id)
    {
        $qb = $this->entityManager->createQueryBuilder('p');
        $qb->where('p.employee_id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->execute();
    }

    public function save(EntityInterface $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

}