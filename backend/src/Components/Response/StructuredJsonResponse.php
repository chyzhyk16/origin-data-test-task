<?php

declare(strict_types=1);

namespace App\Components\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class StructuredJsonResponse extends JsonResponse
{
    public function setData($data = [], $errors = []): static
    {
        $data = [
            'success' => empty($errors),
            'data' => empty($data) ? [] : $data,
            'errors' => empty($errors) ? [] : $errors
        ];

        return parent::setData($data);
    }
}