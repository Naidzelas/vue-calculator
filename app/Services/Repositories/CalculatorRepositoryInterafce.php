<?php

namespace App\Services\Repositories;

interface CalculatorRepositoryInterafce
{

    public function addition($numbers): float|int;
    public function subtraction($numbers): float|int;
    public function division($numbers): float|int;
    public function multiplication($numbers): float|int;
}
