<?php

use PHPUnit\Framework\TestCase;
use App\Calculator\Division;
use App\Calculator\Exceptions\NoOperandsException;

class DivisionTest extends TestCase{
    /** @test */
    public function divide_a_given_operands(){
        $division = new Division();
        $division->setOperands([100,2]);
        $this->assertEquals(50,$division->calculate());
    }

    /** @test */
    public function avoid_division_on_zero(){
        $division = new Division();
        $division->setOperands([0,10,0,2,0,0]);
        $this->assertEquals(5,$division->calculate());
    }

    /** @test */
    public function no_operands_given_throws_an_exception_when_calculating(){
        $this->expectException(NoOperandsException::class);
        $division = new Division();
        $division->calculate();
    }
}