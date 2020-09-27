<?php

namespace Model\Service;

use Model\Entity;
use Model\Contract;

class Calculator
{
    public function produceEquation(string $query): Entity\Equation
    {
        return new Entity\Equation($query);
    }


    public function evaluate(Contract\Computable $equation)
    {
        // just in case, wrapping it in a closure
        $result = (function ($expression) {
            return eval("return ({$expression});");
        })($equation->getExpression());


        $equation->setResult($result);
    }
}
