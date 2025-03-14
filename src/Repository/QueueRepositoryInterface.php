<?php

namespace App\Repository;

use App\Entity\Queue;

interface QueueRepositoryInterface
{
    public function addToQueue(string $item): void;

    public function getFirstInQueue(): ?Queue;

    public function removeFirstFromQueue(): ?Queue;

    public function getLastInQueue(): ?Queue;

    public function getQueueSize(): int;
}