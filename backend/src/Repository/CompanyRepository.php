<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, Company::class);
    }

    public function save(Company $company): void
    {
        $this->entityManager->persist($company);
        $this->entityManager->flush();
    }

    public function remove(Company $company): void
    {
        $this->entityManager->remove($company);
        $this->entityManager->flush();
    }
}
