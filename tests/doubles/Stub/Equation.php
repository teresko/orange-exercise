<?php

namespace Double\Stub;

use Model\Contract\Computable;

class Equation implements Computable
{
    private $value;
    private $result;

    public function __construct(string $value)
    {
        $this->value = $value;
    }


    public function getExpression(): string
    {
        return $this->value;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function getRawResult()
    {
        return $this->result;
    }
}
