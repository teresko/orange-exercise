<?php

namespace Model\Service;

use Model\Entity;

class Memory
{
    public function remember(Entity\Expression $expression)
    {

    }


    public function recall(): Entity\ExpressionCollection
    {
        return new Entity\ExpressionCollection;
    }
}
