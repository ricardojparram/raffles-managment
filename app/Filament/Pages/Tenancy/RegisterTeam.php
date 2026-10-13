<?php

namespace App\Filament\Pages\Tenancy;

use App\Enums\TeamRole;
use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Schema;

class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Crea tu organización';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre de tu organización')
                    ->required()
                    ->maxLength(255),
                TextInput::make('runlot_number')
                    ->label('Registro RUNLOT / CONALOT')
                    ->placeholder('Ej. RUNLOT-2026-0001')
                    ->maxLength(255)
                    ->helperText('Opcional durante configuración. Requerido para operar rifas en Venezuela.'),
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        $team = Team::create($data);

        // Asignar creador como owner del nuevo team
        $team->users()->attach(auth()->user(), ['role' => TeamRole::OWNER->value]);

        return $team;
    }
}
