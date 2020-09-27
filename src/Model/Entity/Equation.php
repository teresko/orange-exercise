<?php

namespace Model\Entity;

use Model\Contract\{HasId, Computable};
use Model\Exception\NotMathematicalExpression;

class Equation implements HasId, Computable
{
    private $id;
    private $expression;
    private $result;


    public function __construct(string $expression)
    {
        $expression = $this->normalize($expression);

        if ($this->isValid($expression) === false) {
            throw new NotMathematicalExpression;
        }

        $this->expression = $expression;
    }


    private function isValid(string $expression): bool
    {
        return preg_match('#^[+-]?\d+(([+/*-]|[/*][+-])\d+)+$#', $expression, $matches);
    }


    private function normalize(string $expression)
    {
        return preg_replace('/[\s\']+/', '', $expression);;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getExpression(): string
    {
        return $this->expression;
    }


    // PHP 8 union types would be really nice here
    public function setResult($result)
    {
        $this->result = $result;
    }


    public function getResult()
    {
        // sneaky to case anything to either int or float
        return $this->result + 0;
    }
}
