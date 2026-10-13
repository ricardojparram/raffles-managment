<?php

namespace App\Filament\Superadmin\Resources\Subscriptions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles de Suscripción')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('subscriber_type')
                                ->label('Tipo de Suscriptor')
                                ->options([
                                    'App\Models\Team' => 'Organización (Team)',
                                ])
                                ->default('App\Models\Team')
                                ->required(),
                            Select::make('subscriber_id')
                                ->label('Organización')
                                ->options(\App\Models\Team::pluck('name', 'id'))
                                ->searchable()
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            Select::make('plan_id')
                                ->label('Plan')
                                ->relationship('plan', 'name')
                                ->required(),
                            TextInput::make('slug')
                                ->label('Identificador (Slug)')
                                ->required()
                                ->maxLength(255),
                        ]),
                        Toggle::make('was_switched')
                            ->label('¿Fue Cambiado?')
                            ->required()
                            ->default(false),
                    ]),

                Section::make('Fechas de Suscripción')
                    ->schema([
                        Grid::make(2)->schema([
                            DateTimePicker::make('started_at')
                                ->label('Fecha de Inicio')
                                ->required(),
                            DateTimePicker::make('expired_at')
                                ->label('Fecha de Expiración'),
                            DateTimePicker::make('canceled_at')
                                ->label('Fecha de Cancelación'),
                            DateTimePicker::make('suppressed_at')
                                ->label('Fecha de Supresión'),
                        ]),
                    ]),
            ]);
    }
}
