<?php

namespace App\Filament\Superadmin\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Información del Usuario')
                    ->description('Detalles personales y de contacto.')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nombre Completo')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->label('Correo Electrónico')
                                ->email()
                                ->required()
                                ->maxLength(255),
                        ]),
                        \Filament\Schemas\Components\Grid::make(2)->schema([
                            \Filament\Forms\Components\ToggleButtons::make('status')
                                ->label('Estado de Cuenta')
                                ->options([
                                    'active' => 'Activo',
                                    'inactive' => 'Inactivo',
                                ])
                                ->colors([
                                    'active' => 'success',
                                    'inactive' => 'danger',
                                ])
                                ->icons([
                                    'active' => 'heroicon-m-check-circle',
                                    'inactive' => 'heroicon-m-x-circle',
                                ])
                                ->inline()
                                ->required()
                                ->default('active'),
                            DateTimePicker::make('email_verified_at')
                                ->label('Fecha de Verificación'),
                        ]),
                    ]),

                \Filament\Schemas\Components\Section::make('Seguridad')
                    ->description('Gestionar la contraseña del usuario.')
                    ->schema([
                        TextInput::make('password')
                            ->label('Contraseña')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->maxLength(255),
                    ])->collapsed(fn (string $operation): bool => $operation !== 'create'),

                \Filament\Schemas\Components\Section::make('Asignación de Permisos')
                    ->description('Configurar organizaciones y roles globales.')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)->schema([
                            \Filament\Forms\Components\Select::make('teams')
                                ->label('Organizaciones (Tenants)')
                                ->multiple()
                                ->relationship('teams', 'name')
                                ->preload()
                                ->searchable(),
                            \Filament\Forms\Components\Select::make('roles')
                                ->label('Roles Globales')
                                ->multiple()
                                ->relationship('roles', 'name', fn (\Illuminate\Database\Eloquent\Builder $query) => $query->whereNull('roles.team_id'))
                                ->preload()
                                ->searchable()
                                ->disabled(fn (?\App\Models\User $record): bool => $record && $record->hasRole('super_admin')),
                        ]),
                    ]),
            ]);
    }
}
