<?php

namespace App\Service;

use App\Entity\Queue;
use App\Repository\QueueRepositoryInterface;

class QueueService implements QueueServiceInterface
{

    public function __construct(private readonly QueueRepositoryInterface $queueRepository)
    {
    }

    public function enqueue(string $item): void
    {
        $this->queueRepository->addToQueue($item);
    }

    public function dequeue(): ?Queue
    {
        return $this->queueRepository->removeFirstFromQueue();
    }

    public function peek(): ?Queue
    {
        return $this->queueRepository->getFirstInQueue();
    }

    public function rear(): ?Queue
    {
        return $this->queueRepository->getLastInQueue();
    }

    public function isEmpty(): bool
    {
        return !$this->size();
    }

    public function size(): int
    {
        return $this->queueRepository->getQueueSize();
    }
}