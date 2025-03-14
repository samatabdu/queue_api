<?php

namespace App\Controller\Api;

use App\Service\QueueServiceInterface;
use App\Validation\QueueValidation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api', name: 'api_')]
class QueueController extends AbstractController
{
    public function __construct(private readonly QueueServiceInterface $queueService)
    {

    }

    #[Route('/enqueue', name: 'enqueue', methods: ['POST'])]
    public function enqueue(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $rawData = json_decode($request->getContent(), true);

        $validator = new QueueValidation($rawData, $validator);
        if (!$validator->isValid()) {
            return $this->json(['error' => $validator->getErrors()], Response::HTTP_NOT_FOUND);
        }

        try {
            $this->queueService->enqueue($validator->getItem());
            return $this->json(['message' => 'Item added to queue'], 201);
        } catch (\Throwable $e) {
            return $this->json(['error' => 'Unexpected error'], 500);
        }
    }

    #[Route('/dequeue', name: 'dequeue', methods: ['GET'])]
    public function dequeue(): JsonResponse
    {
        $item = $this->queueService->dequeue();
        if ($item === null) {
            return $this->json(['message' => 'Queue is empty'], 400);
        }

        return $this->json($item->getItem());
    }

    #[Route('/peek', name: 'peek', methods: ['GET'])]
    public function peek(): JsonResponse
    {
        $item = $this->queueService->peek();
        if ($item === null) {
            return $this->json(['message' => 'Queue is empty'], 400);
        }

        return $this->json($item->getItem());
    }

    #[Route('/rear', name: 'rear', methods: ['GET'])]
    public function rear(): JsonResponse
    {
        $item = $this->queueService->rear();

        if ($item === null) {
            return $this->json(['message' => 'Queue is empty'], 400);
        }

        return $this->json($item->getItem());
    }

    #[Route('/is-empty', name: 'is-empty', methods: ['GET'])]
    public function isEmpty(): JsonResponse
    {
        return $this->json(['isEmpty' => $this->queueService->isEmpty()]);
    }

    #[Route('/size', name: 'size', methods: ['GET'])]
    public function size(): JsonResponse
    {
        return $this->json(['size' => $this->queueService->size()]);
    }
}