<?php

namespace App\Models\Calculator;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    public $fillable = [
        'calculation_id',
        'operation'
    ];
}
