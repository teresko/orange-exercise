<?php

namespace Model\Service;

use Model\Entity;

class Calculator
{
    public function produceEquation(string $query): Entity\Equation
    {
        return new Entity\Equation;
    }


    public function evaluate(Entity\Equation $equation)
    {

    }
}
