<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Model\Service\Memory;
use Component\Template;

class History
{
    private $memory;


    public function __construct(Memory $memory)
    {
        $this->memory = $memory;
    }


    public function getCollection(Request $request): array
    {
        $expressions = $this->memory->recall();

        $template = new Template(__DIR__ . '/../Template/expression-collection.php');
        return $template->render([
            'list' => $expressions,
        ]);
    }
}
