<?php

namespace Model\Entity;

use Model\Contract\HasId;
use Component\Collection;

class EquationCollection extends Collection
{
    protected function buildEntity(): HasId
    {
        return new Equation;
    }
}
