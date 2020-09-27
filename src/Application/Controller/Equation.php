<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Model\Service\{Calculator, Memory};
use Component\Template;

class Equation
{
    private $calc;
    private $memory;


    public function __construct(Calculator $calc, Memory $memory)
    {
        $this->calc = $calc;
        $this->memory = $memory;
    }


    public function postResource(Request $request): array
    {
        $expression = $this->calc->produceExpression($request->get('query'));
        $this->calc->evaluate($expression);

        $this->memory->remember($expression);

        $template = new Template(__DIR__ . '/../Template/expression.php');
        return $template->render([
            'expression' => $expression,
        ]);
    }
}
