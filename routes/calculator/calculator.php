<?php

use App\Http\Controllers\Calculator\CalculationController;
use Illuminate\Support\Facades\Route;

Route::get('/calculator', [CalculationController::class, 'index'])->name('calculation.index');
Route::post('/calculator/create', [CalculationController::class, 'create'])->name('calculation.create');
