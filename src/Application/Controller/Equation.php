<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\{Request, JsonResponse};

class Equation
{
    public function postResource(Request $request): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
