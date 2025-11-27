<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Schemas\Schema;
use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;

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
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        $team = Team::create($data);

        // Asignar usuario como admin del nuevo team
        $team->users()->attach(auth()->user(), ['role' => 'admin']);

        return $team;
    }
}
