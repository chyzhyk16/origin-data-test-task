<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;


class CompanyDTO
{
    public ?int $id = null;

    #[Assert\NotBlank]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    public string $phone;

    public ?string $address = null;
}