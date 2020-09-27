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



}
