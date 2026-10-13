<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\TeamRole;
use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $tenant = Filament::getTenant();
        if ($tenant) {
            $role = $this->data['team_role'] ?? TeamRole::SELLER->value;
            $this->record->teams()->syncWithoutDetaching([
                $tenant->id => ['role' => $role],
            ]);
        }
    }
}
