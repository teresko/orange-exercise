<?php

namespace Model\Service;

use Model\Entity;

class Calculator
{
    public function produceExpression(string $query): Entity\Expression
    {
        return new EntityExpression;
    }


    public function evaluate(Entity\Expression $expression)
    {

    }
}
