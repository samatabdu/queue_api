<?php

namespace App\Repository;

use App\Entity\Queue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Queue>
 */
class QueueRepository extends ServiceEntityRepository implements QueueRepositoryInterface
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Queue::class);
        $this->entityManager = $entityManager;
    }

    public function addToQueue(string $item): void
    {
        $queueItem = new Queue();
        $queueItem->setItem($item);

        $this->entityManager->persist($queueItem);
        $this->entityManager->flush();
    }

    public function removeFirstFromQueue(): ?Queue
    {
        $firstItem = $this->getFirstInQueue();

        if ($firstItem) {
            $this->entityManager->remove($firstItem);
            $this->entityManager->flush();
        }

        return $firstItem;
    }

    public function getFirstInQueue(): ?Queue
    {
        return $this->findOneBy([], ['created_at' => 'ASC']);
    }

    public function getLastInQueue(): ?Queue
    {
        return $this->findOneBy([], ['created_at' => 'DESC']);
    }

    public function getQueueSize(): int
    {
        return $this->count([]);
    }
}
