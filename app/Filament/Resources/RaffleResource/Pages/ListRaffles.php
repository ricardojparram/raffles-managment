<?php

namespace App\Filament\Resources\RaffleResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\RaffleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRaffles extends ListRecords
{
    protected static string $resource = RaffleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
