<?php

namespace Model\Entity;

use Model\Contract\HasId;

class Equation implements HasId
{
    private $id = 7;
    private $expression = '2 + 3 * 4';
    private $result = 14;

    public function getId()
    {
        return $this->id;
    }


    public function getExpression(): ?string
    {
        return $this->expression;
    }


    public function getResult()
    {
        return $this->result;
    }
}
