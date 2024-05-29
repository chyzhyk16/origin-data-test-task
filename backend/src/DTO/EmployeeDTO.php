<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\Company;
use Symfony\Component\Validator\Constraints as Assert;


class EmployeeDTO
{
    public ?int $id = null;

    #[Assert\NotBlank]
    public string $firstName;

    #[Assert\NotBlank]
    public string $lastName;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    public string $position;

    #[Assert\PositiveOrZero]
    public int $salary;

    #[Assert\NotNull]
    public int $companyId;
}