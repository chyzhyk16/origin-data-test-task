<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CompanyDTO;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyService
{
    public function __construct(
        private CompanyRepository $companyRepository,
    ) {
    }

    public function getAll(): array
    {
        return $this->companyRepository->findAll();
    }

    public function getById(int $id): ?Company
    {
        $company = $this->companyRepository->find($id);

        if (!$company) {
            throw new NotFoundHttpException('Company not found');
        }

        return $company;
    }

    public function create(CompanyDTO $companyCreateDTO): Company
    {
        $company = new Company(
            $companyCreateDTO->name,
            $companyCreateDTO->email,
            $companyCreateDTO->phone,
            $companyCreateDTO->address,
        );

        $this->companyRepository->save($company);

        return $company;
    }

    public function update(CompanyDTO $companyCreateDTO): Company
    {
        $company = $this->getById($companyCreateDTO->id);

        $company->setName($companyCreateDTO->name)
            ->setEmail($companyCreateDTO->email)
            ->setPhone($companyCreateDTO->phone)
            ->setAddress($companyCreateDTO->address);

        $this->companyRepository->save($company);

        return $company;
    }

    public function deleteById(int $id): void
    {
        $company = $this->getById($id);

        $this->companyRepository->remove($company);
    }
}