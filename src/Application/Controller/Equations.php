<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Model\Service\{Calculator, Memory};
use Component\Template;

class Equations
{
    private $calc;
    private $memory;


    public function __construct(Calculator $calc, Memory $memory)
    {
        $this->calc = $calc;
        $this->memory = $memory;
    }


    public function getCollection(Request $request): array
    {
        $equations = $this->memory->recall();

        return (function ($list) {
            return require __DIR__ . '/../Template/equation-collection.php';
        })($equations);
    }


    public function postResource(Request $request): array
    {
        $equation = $this->calc->produceEquation($request->get('query'));
        $this->calc->evaluate($equation);

        $this->memory->remember($equation);

        return (function ($equation) {
            return require __DIR__ . '/../Template/equation.php';
        })($equation);
    }
}
