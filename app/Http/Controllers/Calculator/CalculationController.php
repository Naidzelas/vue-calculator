<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\CalculatorService;
use App\Models\Calculator\Calculation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalculationController extends Controller
{
    private $calculator;
    public function __construct(CalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }
    public function index(Request $request)
    {
        $calculations = Calculation::where('user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->limit(10)->get();

        return Inertia::render('Calculator', [
            'result' => (float) $calculations->first()->result,
            'calculatorHistory' => $calculations
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'operation' => 'array|required',
        ]);

        $result = $this->calculator->calculate($request->operation);
        Calculation::create([
            'user_id' => $request->user()->id,
            'operation' => implode(' ', $request->operationDB),
            'result' => $result,
        ]);

        return to_route('calculation.index');
    }
}
