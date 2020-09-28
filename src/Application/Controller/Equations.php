<?php

namespace Application\Controller;

use Model\Service;
use Symfony\Component\HttpFoundation\Request;

class Equations
{
    private $calc;
    private $memory;


    public function __construct(Service\Calculator $calc, Service\Memory $memory)
    {
        $this->calc = $calc;
        $this->memory = $memory;
    }


    public function getCollection(Request $request): array
    {
        $equations = $this->memory->recallAll();

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


    public function getResource(Request $request): array
    {
        $equation = $this->memory->recall($request->get('id'));

        return (function ($equation) {
            return require __DIR__ . '/../Template/equation.php';
        })($equation);
    }
}
