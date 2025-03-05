<?php

namespace App\Services\Providers;

use App\Services\Repositories\CalculatorRepositoryInterafce;
use App\Services\Repositories\CalculatorRepository;
use Illuminate\Support\ServiceProvider;

class CalculatorProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        match ($this->app->environment()) {
            default => $this->app->singleton(CalculatorRepositoryInterafce::class, function($app){
               return new CalculatorRepository();
            }),
        };
    }
}
