<?php

declare(strict_types=1);

namespace App\Components\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait EntityDateTime
{
    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE, nullable: false, options: ['default' => "CURRENT_TIMESTAMP"])]
    protected DateTimeInterface $createdAt;

    #[ORM\Column(name: 'updated_at',type: Types::DATETIME_MUTABLE,  nullable: false, options: ['default' => "CURRENT_TIMESTAMP"])]
    protected DateTimeInterface $updatedAt;

    #[ORM\PrePersist]
    public function updateCreatedAt(): void
    {
        $this->createdAt = new DateTime('now');
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateUpdatedAt(): void
    {
        $this->updatedAt = new DateTime('now');
    }

    public function getCreatedAt(): DateTimeInterface
    {
        if (empty($this->createdAt)) {
            $this->createdAt = new DateTime('now');
        }
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        if (empty($this->updatedAt)) {
            $this->updatedAt = new DateTime('now');
        }
        return $this->updatedAt;
    }
}