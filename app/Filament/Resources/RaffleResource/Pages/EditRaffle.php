<?php

namespace App\Filament\Resources\RaffleResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\RaffleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRaffle extends EditRecord
{
    protected static string $resource = RaffleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
