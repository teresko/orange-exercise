<?php

namespace Model\Entity;

use Component\Collection;
use Model\Contract\HasId;

class EquationCollection extends Collection
{
    protected function buildEntity(): HasId
    {
        return new Equation();
    }
}
