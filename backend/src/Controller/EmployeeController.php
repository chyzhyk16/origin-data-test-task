<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\EmployeeDTO;
use App\Service\EmployeeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employee', name: 'employee_')]
class EmployeeController extends AbstractController
{
    public function __construct(
        private readonly EmployeeService $employeeService
    ) {
    }

    #[Route('', methods: ['GET'])]
    public function list(): Response
    {
        return $this->json($this->employeeService->getAll());
    }

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function get(int $id): Response
    {
        return $this->json($this->employeeService->getById($id));
    }

    #[Route('', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] EmployeeDTO $dto
    ): Response {
        $employee = $this->employeeService->create($dto);

        return $this->json($employee);
    }

    #[Route('/{id<\d+>}', methods: ['PUT'])]
    public function update(
        int $id,
        #[MapRequestPayload] EmployeeDTO $dto
    ): Response {
        $dto->id = $id;

        $employee = $this->employeeService->update($dto);

        return $this->json($employee);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $this->employeeService->deleteById($id);

        return $this->json([]);
    }
}
