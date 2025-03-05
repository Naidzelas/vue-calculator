<?php

namespace App\Services\Facades;

use App\Services\Repositories\CalculatorRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Tag\Repositories\TagRepository
 */
class Calculator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CalculatorRepository::class;
    }
}
