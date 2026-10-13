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

        $user = auth()->user();
        // Asignar usuario como admin del nuevo team
        $team->users()->attach($user, ['role' => 'admin']);

        // Asignar el rol de Spatie
        setPermissionsTeamId($team->id);
        $user->assignRole('admin');

        return $team;
    }
}
