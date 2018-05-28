<?php

use PHPUnit\Framework\TestCase;
use App\Calculator\Addition;
use App\Calculator\Calculator;
use App\Calculator\Division;

class CalculatorTest extends TestCase{
    /** @test */
    public function can_set_single_operation(){
        $addition = new Addition();
        $addition->setOperands([10,5]);
        $calculator = new Calculator();
        $calculator->setOperation($addition);
        $this->assertCount(1,$calculator->getOperations());
    }

    /** @test */
    public function can_set_multiple_operations(){
        $addition = new Addition();
        $addition->setOperands([10,5,40]);
        $division = new Division();
        $division->setOperands([100,4,5]);
        $calculator = new Calculator();
        $calculator->setOperations([$addition,$division]);
        $this->assertCount(2,$calculator->getOperations());
    }

    /** @test */
    public function operations_are_ignored_when_they_are_not_instance_of_OperationInterface(){
        $addition = new Addition();
        $addition->setOperands([10,5,40]);
        $calculator = new Calculator();
        $calculator->setOperations([$addition,'hello','world']);
        $this->assertCount(1,$calculator->getOperations());
    }

    /** @test */
    public function can_get_the_result_of_single_operation_calculation(){
        $addition = new Addition();
        $addition->setOperands([10,5,40]);
        $calculator = new Calculator();
        $calculator->setOperation($addition);
        $this->assertEquals(55,$calculator->calculate());
    }

    /** @test */
    public function can_get_an_array_of_results_for_multiple_operation_calculations(){
        $addition = new Addition();
        $addition->setOperands([10,5,40]);
        $division = new Division();
        $division->setOperands([100,4,5]);
        $calculator = new Calculator();
        $calculator->setOperations([$addition,$division]);
        $result = $calculator->calculate();
        $this->assertInternalType('array',$result);
        $this->assertEquals(55,$result[0]);
        $this->assertEquals(5,$result[1]);
    }
}