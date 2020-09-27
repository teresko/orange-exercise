<?php

namespace Model\Contract;

interface Computable
{
    public function getExpression(): string;
    public function setResult($result);
}
