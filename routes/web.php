<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Welcome'));

require __DIR__ . '/auth.php';
require __DIR__ . '/calculator/calculator.php';
