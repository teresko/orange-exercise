<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\{Request, JsonResponse};

class History
{
    public function getCollection(Request $request): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
