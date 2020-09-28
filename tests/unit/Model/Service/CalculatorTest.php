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


    /**
     * @test
     */
    public function Compute_Result_for_Expression_Contained_in_an_Equation_with_Float()
    {
        $instance = new Calculator;
        $double = new Equation('2 * 1.4');
        $instance->evaluate($double);
        $this->assertSame(2.8, $double->getRawResult());
    }


    /**
     * @test
     */
    public function Exception_when_Diviting_by_Zero()
    {
        $this->expectException(\DivisionByZeroError::class);
        $instance = new Calculator;
        $double = new Equation('9 / 0');
        $instance->evaluate($double);
    }
}
