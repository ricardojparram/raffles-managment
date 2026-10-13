<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TeamType: string implements HasLabel
{
    case Individual = 'individual';
    case Organization = 'organization';

    public function getLabel(): string
    {
        return match ($this) {
            self::Individual => __('Individual'),
            self::Organization => __('Organization'),
        };
    }
}
