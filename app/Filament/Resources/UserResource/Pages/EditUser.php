<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $tenant = Filament::getTenant();
        if ($tenant && isset($this->data['team_role'])) {
            if (! $this->record->isOwnerOf($tenant)) {
                $this->record->teams()->updateExistingPivot($tenant->id, [
                    'role' => $this->data['team_role'],
                ]);
            }
        }
    }
}
