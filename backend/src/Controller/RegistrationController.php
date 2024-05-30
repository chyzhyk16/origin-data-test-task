<?php

namespace App\Controller;

use App\Components\Response\StructuredJsonResponse;
use App\DTO\UserDTO;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    public function __construct(
        private UserService $userService
    ) {
    }

    #[Route('user/register', name: 'app_user_registration', methods: 'POST')]
    public function register(
        #[MapRequestPayload] UserDto $dto,
    ): JsonResponse {
        $this->userService->createUser($dto);

        return new StructuredJsonResponse([
            'message' => 'Registered Successfully'
        ]);
    }
}
