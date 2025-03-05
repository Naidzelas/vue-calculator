<?php

namespace App\Services\Repositories;

use App\Services\Repositories\CalculatorRepositoryInterafce;

class CalculatorRepository implements CalculatorRepositoryInterafce
{

    public function addition($numbers): float|int
    {
        return $numbers[0] + $numbers[1];
    }
    public function subtraction($numbers): float|int
    {
        return $numbers[0] - $numbers[1];
    }
    public function division($numbers): float|int
    {
        return $numbers[0] / $numbers[1];
    }
    public function multiplication($numbers): float|int
    {
        return $numbers[0] * $numbers[1];
    }
}
