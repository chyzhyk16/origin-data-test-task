<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employee>
 */
class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, Employee::class);
    }

    public function save(Employee $company): void
    {
        $this->entityManager->persist($company);
        $this->entityManager->flush();
    }

    public function remove(Employee $company): void
    {
        $this->entityManager->remove($company);
        $this->entityManager->flush();
    }
}
