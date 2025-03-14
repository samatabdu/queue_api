<?php

namespace App\Service;

use App\Entity\Queue;

interface QueueServiceInterface
{
    public function enqueue(string $item): void;

    public function dequeue(): ?Queue;

    public function peek(): ?Queue;

    public function rear(): ?Queue;

    public function isEmpty(): bool;

    public function size(): int;
}