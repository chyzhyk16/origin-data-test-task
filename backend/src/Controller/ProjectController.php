<?php

declare(strict_types=1);

namespace App\Controller;

use App\Components\Response\StructuredJsonResponse;
use App\DTO\ProjectDTO;
use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/project', name: 'project_')]

class ProjectController extends AbstractController
{
    public function __construct(
        private readonly ProjectService $projectService
    ) {
    }

    #[Route('', methods: ['GET'])]
    public function list(): Response
    {
        return new StructuredJsonResponse($this->projectService->getAll());
    }

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new StructuredJsonResponse($this->projectService->getById($id));
    }

    #[Route('', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] ProjectDTO $dto
    ): Response {
        $project = $this->projectService->create($dto);

        return new StructuredJsonResponse($project);
    }

    #[Route('/{id<\d+>}', methods: ['PUT'])]
    public function update(
        int $id,
        #[MapRequestPayload] ProjectDTO $dto
    ): Response {
        $dto->id = $id;

        $project = $this->projectService->update($dto);

        return new StructuredJsonResponse($project);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $this->projectService->deleteById($id);

        return new StructuredJsonResponse([]);
    }
}
