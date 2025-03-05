<?php

namespace App\Http\Controllers\Services;

use App\Enums\Operator;
use App\Services\Facades\Calculator;

class CalculatorService
{
    public function calculate($operations)
    {
        $numbers = [];
        $operators = [];

        foreach ($operations as $operation) {
            if (is_numeric($operation)) {
                $numbers[] = $operation;
            } else {
                $operator = Operator::from($operation);
                while (!empty($operators) && $operators[count($operators) - 1]->priority() >= $operator->priority()) {
                    $num2 = array_pop($numbers);
                    $num1 = array_pop($numbers);
                    $prevOperator = array_pop($operators);


                    $result = match ($prevOperator) {
                        Operator::MULTIPLICATION => Calculator::multiplication([$num1, $num2]),
                        Operator::DIVISION => Calculator::division([$num1, $num2]),
                        Operator::ADDITION => Calculator::addition([$num1, $num2]),
                        Operator::SUBTRACTION => Calculator::subtraction([$num1, $num2]),
                    };
                    $numbers[] = $result;
                }
                $operators[] = $operator;
            }
        }

        while (!empty($operators)) {
            $num2 = array_pop($numbers);
            $num1 = array_pop($numbers);
            $operator = array_pop($operators);

            $result = match ($operator) {
                Operator::MULTIPLICATION => Calculator::multiplication([$num1, $num2]),
                Operator::DIVISION => Calculator::division([$num1, $num2]),
                Operator::ADDITION => Calculator::addition([$num1, $num2]),
                Operator::SUBTRACTION => Calculator::subtraction([$num1, $num2]),
            };
            $numbers[] = $result;
        }

        return $numbers[0];
    }
}
