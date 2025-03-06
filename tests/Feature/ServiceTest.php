<?php

use App\Http\Controllers\Services\CalculatorService;

test('calculation', function () {

    $mathArray = [4,'addition',4,'multiplication',4];
    $calculator = new CalculatorService();
    expect($calculator->calculate($mathArray))->toBe(20);
});
