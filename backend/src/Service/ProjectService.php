<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\ProjectDTO;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectService
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private CompanyService    $companyService
    ) {
    }

    public function getAll(): array
    {
        return $this->projectRepository->findAll();
    }

    public function getById(int $id): ?Project
    {
        $project = $this->projectRepository->find($id);

        if (!$project) {
            throw new NotFoundHttpException('Project not found');
        }

        return $project;
    }

    public function create(ProjectDTO $dto): Project
    {
        $company = $this->companyService->getById($dto->companyId);

        $project = new Project(
            $dto->name,
            $dto->description,
            $company
        );

        $this->projectRepository->save($project);

        return $project;
    }

    public function update(ProjectDTO $dto): Project
    {
        $project = $this->getById($dto->id);
        $company = $this->companyService->getById($dto->companyId);

        $project->setName($dto->name)
            ->setDescription($dto->description)
            ->setCompany($company);

        $this->projectRepository->save($project);

        return $project;
    }

    public function deleteById(int $id): void
    {
        $project = $this->getById($id);

        $this->projectRepository->remove($project);
    }
}