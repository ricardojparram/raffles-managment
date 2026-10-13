<?php

namespace App\Filament\Schemas\Components;

use Filament\Forms\Components\TextInput;

/**
 * Text input that edits an amount in major units while persisting integer cents.
 */
class MoneyInput extends TextInput
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->currencyMask(',', '.', 2)
            ->rule('numeric')
            ->minValue(0)
            ->formatStateUsing(fn (mixed $state): ?string => blank($state) ? null : number_format(((int) $state) / 100, 2, '.', ''))
            ->dehydrateStateUsing(fn (mixed $state): ?int => blank($state) ? null : (int) round(((float) $state) * 100));
    }
}
