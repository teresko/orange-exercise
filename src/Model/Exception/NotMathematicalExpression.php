<?php

namespace Model\Exception;

class NotMathematicalExpression extends \Exception
{
    protected $message = 'Provided arithmetical expression is malformed';
}
