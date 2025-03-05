<?php

namespace App\Enums;

enum Operator: string
{
    case ADDITION = 'addition';
    case SUBTRACTION = 'subtraction';
    case DIVISION = 'division';
    case MULTIPLICATION = 'multiplication';

    private const HIGH = 2;
    private const LOW = 1;

    public function priority(): int
    {
        return match ($this) {
            Operator::ADDITION => self::LOW,
            Operator::SUBTRACTION => self::LOW,
            Operator::DIVISION => self::HIGH,
            Operator::MULTIPLICATION => self::HIGH
        };
    }
}
