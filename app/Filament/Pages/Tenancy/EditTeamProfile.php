<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile;
use Filament\Schemas\Schema;

class EditTeamProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return __('Organization Profile');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Organization Name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('runlot_number')
                    ->label(__('RUNLOT / CONALOT Registry'))
                    ->placeholder('RUNLOT-2026-0001')
                    ->maxLength(255)
                    ->helperText(__('Permit or registration number issued by CONALOT for this organizer.')),
            ]);
    }
}
