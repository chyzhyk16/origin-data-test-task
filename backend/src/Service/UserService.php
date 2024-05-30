<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }
    public function createUser(UserDTO $dto): User
    {
        $user = new User(
            $dto->email,
            password_hash($dto->password, PASSWORD_DEFAULT),
            $dto->firstName,
            $dto->lastName
        );

        $this->userRepository->save($user);

        return $user;
    }
}