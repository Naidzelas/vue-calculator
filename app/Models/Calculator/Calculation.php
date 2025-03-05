<?php

namespace App\Models\Calculator;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    public $fillable = [
        'user_id',
        'operation',
        'result'
    ];
}
