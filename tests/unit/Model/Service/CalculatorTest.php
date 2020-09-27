<?php

namespace Model\Service;

use PHPUnit\Framework\TestCase;
use Model\Exception;
use Double\Stub\Equation;

class CalculatorTest extends TestCase
{

    /**
     * @test
     */
    public function Compute_Result_for_Expression_Contained_in_an_Equation()
    {
        $instance = new Calculator;
        $double = new Equation('-2+4*3+12/-3-1');
        $instance->evaluate($double);
        $this->assertSame(5, $double->getRawResult());
    }
}
