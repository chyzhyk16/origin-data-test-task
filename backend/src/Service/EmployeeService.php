<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\EmployeeDTO;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmployeeService
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private CompanyService     $companyService
    ) {
    }

    public function getAll(): array
    {
        return $this->employeeRepository->findAll();
    }

    public function getById(int $id): ?Employee
    {
        $employee = $this->employeeRepository->find($id);

        if (!$employee) {
            throw new NotFoundHttpException('Employee not found');
        }

        return $employee;
    }

    public function create(EmployeeDTO $dto): Employee
    {
        $company = $this->companyService->getById($dto->companyId);

        $employee = new Employee(
            $dto->firstName,
            $dto->lastName,
            $dto->email,
            $dto->position,
            $dto->salary,
            $company
        );

        $this->employeeRepository->save($employee);

        return $employee;
    }

    public function update(EmployeeDTO $dto): Employee
    {
        $employee = $this->getById($dto->id);
        $company = $this->companyService->getById($dto->companyId);

        $employee->setFirstName($dto->firstName)
            ->setLastName($dto->lastName)
            ->setEmail($dto->email)
            ->setPosition($dto->position)
            ->setSalary($dto->salary)
            ->setCompany($company);

        $this->employeeRepository->save($employee);

        return $employee;
    }

    public function deleteById(int $id): void
    {
        $employee = $this->getById($id);

        $this->employeeRepository->remove($employee);
    }
}