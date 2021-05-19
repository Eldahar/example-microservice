<?php


namespace App\Manager;


use Doctrine\ORM\Mapping\OrderBy;
use function Doctrine\ORM\QueryBuilder;

class RegistrationManager extends AbstractEntityManager
{
    public function findAllByCardID(int $cardID)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('p')
            ->from('App:Registration', 'p')
            ->where($qb->expr()->eq('p.cardID', $cardID))
            ->orderBy('p.time', 'ASC');

        return $qb->getQuery()->execute();
    }

    public function findAllByCardIDAndDay(int $cardID, \DateTime $day)
    {
        $from = clone $day;
        $from->setTime(0, 0, 0);
        $to = clone $from;
        $to->add(new \DateInterval('P1D'));

        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('p')
            ->from('App:Registration', 'p')
            ->andWhere(
                "p.time BETWEEN :from AND :to",
                "p.cardID = :cardID"
            )
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->setParameter('cardID', $cardID)
            ->orderBy('p.time', 'ASC');

        return $qb->getQuery()->execute();
    }
}