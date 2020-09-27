<?php

namespace Model\Entity;

use Model\Contract\HasId;
use Component\Collection;

class EquationCollection extends Collection
{
    public function __construct()
    {
        $this->addEntity(new Equation);
    }

    protected function buildEntity(): HasId
    {
        return Equation;
    }
}
