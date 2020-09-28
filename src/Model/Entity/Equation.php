<?php

namespace Model\Entity;

use Model\Contract;
use Model\Exception\NotMathematicalExpression;

class Equation implements Contract\HasId, Contract\Computable
{
    private $id;
    private $expression;
    private $result;


    public function __construct(string $expression = null)
    {
        if ($expression !== null) {
            $this->setExpression($expression);
        }
    }


    private function isValid(string $expression): bool
    {
        return preg_match('#^[+-]?\d+(\.\d+)?(([+/*-]|[/*][+-])\d+(\.\d+)?)+$#', $expression, $matches);
    }


    private function normalize(string $expression)
    {
        $expression = strtr($expression, [
            '−' => '-',
            '×' => '*',
            '÷' => '/',
        ]);

        return preg_replace('/[\s\']+/', '', $expression);
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setExpression(string $expression): void
    {
        $expression = $this->normalize($expression);

        if ($this->isValid($expression) === false) {
            throw new NotMathematicalExpression();
        }

        $this->expression = $expression;
    }


    public function getExpression(): string
    {
        return $this->expression;
    }


    public function getFormatedExpression(): string
    {
        $expression = $this->getExpression();

        preg_match_all('#([+-/*])|(\d+(?:\.\d+)?)#', $expression, $matches);

        $expression = implode(' ', $matches[0]);

        return strtr($expression, [
            '-' => '−',
            '*' => '×',
            '/' => '÷',
        ]);
    }


    // PHP 8 union types would be really nice here
    public function setResult($result): void
    {
        $this->result = $result;
    }


    public function getResult()
    {
        // sneaky to case anything to either int or float
        return $this->result + 0;
    }
}
