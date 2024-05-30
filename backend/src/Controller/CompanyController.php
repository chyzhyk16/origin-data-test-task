<?php

declare(strict_types=1);

namespace App\Controller;

use App\Components\Response\StructuredJsonResponse;
use App\DTO\CompanyDTO;
use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/company', name: 'company_')]
class CompanyController extends AbstractController
{
    public function __construct(
        private readonly CompanyService $companyService
    ) {
    }

    #[Route('', methods: ['GET'])]
    public function list(): Response
    {
        return new StructuredJsonResponse($this->companyService->getAll());
    }

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return new StructuredJsonResponse($this->companyService->getById($id));
    }

    #[Route('', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CompanyDTO $dto
    ): Response {
        $company = $this->companyService->create($dto);

        return new StructuredJsonResponse($company);
    }

    #[Route('/{id<\d+>}', methods: ['PUT'])]
    public function update(
        int $id,
        #[MapRequestPayload] CompanyDTO $dto
    ): Response {
        $dto->id = $id;

        $company = $this->companyService->update($dto);

        return new StructuredJsonResponse($company);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $this->companyService->deleteById($id);

        return new StructuredJsonResponse([]);
    }
}
