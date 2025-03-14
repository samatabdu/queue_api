<?php

namespace App\Repository;

use App\Entity\Queue;

interface QueueRepositoryInterface
{
    public function getFirstInQueue(): ?Queue;
}