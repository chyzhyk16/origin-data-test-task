<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Employee;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $company = new Company(
            'Tech Innovators Inc.',
            'contact@techinnovators.com',
            '+1234567890',
            '123 Innovation Drive, Tech City, TC 12345'
        );
        $manager->persist($company);

        // Create Employee
        $employee = new Employee(
            'John',
            'Doe',
            'john.doe@example.com',
            'Software Engineer',
            80000,
            $company
        );
        $manager->persist($employee);

        // Create Project
        $project = new Project(
            'New Website Development',
            'Development of a new e-commerce website.',
            $company
        );
        $manager->persist($project);

        $manager->flush();
    }
}
