<?php

namespace Model\Service;

use Model\Entity;

class Memory
{
    public function remember(Entity\Equation $equation)
    {

    }


    public function recall(): Entity\EquationCollection
    {
        return new Entity\EquationCollection;
    }
}
