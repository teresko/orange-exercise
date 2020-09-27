<?php

namespace Model\Entity;

use PHPUnit\Framework\TestCase;
use Model\Exception;

class EquationTest extends TestCase
{

    /**
     * @test
     * @dataProvider Provide_List_of_Valid_Expressions
     */
    public function Strip_Whitespace_from_Expression($expression, $expected)
    {
        $instance = new Equation($expression);
        $this->assertSame($expected, $instance->getExpression());
    }

    public function Provide_List_of_Valid_Expressions()
    {
        return [
            ['-1-2 -  3-4', '-1-2-3-4'],
            ['1 + 2', '1+2'],
            [' -23 - 5/3 ', '-23-5/3'],
            ['2 000 + 1', '2000+1'],
            ['88\'888  * -2', '88888*-2'],
        ];
    }


    /**
     * @test
     * @dataProvider Provide_List_of_Fancy_Expressions
     */
    public function Replace_Fancy_Symbols_with_Proper_Math_Signs($expression, $expected)
    {
        $instance = new Equation($expression);
        $this->assertSame($expected, $instance->getExpression());
    }

    public function Provide_List_of_Fancy_Expressions()
    {
        return [
            ['2 × 2', '2*2'],
            ['2 × 2 × 2', '2*2*2'],
            ['1 − 2 - 2 ÷ 2', '1-2-2/2'],
        ];
    }


    /**
     * @test
     * @dataProvider Provide_List_of_Invalid_Expressions
     */
    public function Throw_Exception_when_Invalid_Expression_Assigned($expression)
    {
        $this->expectException(Exception\NotMathematicalExpression::class);
        $instance = new Equation($expression);
    }

    public function Provide_List_of_Invalid_Expressions()
    {
        return [
            ['3+a'],
            ['  *3-1  '],
            ['1234*23-244-'],
        ];
    }



    /**
     * @test
     * @dataProvider Provide_Expressions_to_Format
     */
    public function Formating_of_Expression_Add_Fancy_Symbols($expression, $expected)
    {
        $instance = new Equation($expression);
        $this->assertSame($expected, $instance->getFormatedExpression());
    }

    public function Provide_Expressions_to_Format()
    {
        return [
            ['8*4', '8 × 4'],
            ['2*-5*2', '2 × − 5 × 2'],
        ];
    }
}
