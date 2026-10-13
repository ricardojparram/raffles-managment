<?php

namespace App\Filament\Superadmin\Resources\Plans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Plan')
                    ->description('Detalles básicos del plan de suscripción.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nombre del Plan')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('slug')
                                ->label('Slug')
                                ->required()
                                ->maxLength(255),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('price')
                                ->label('Precio')
                                ->required()
                                ->numeric()
                                ->prefix('$')
                                ->default(0.00),
                            TextInput::make('signup_fee')
                                ->label('Tarifa de Inscripción')
                                ->required()
                                ->numeric()
                                ->prefix('$')
                                ->default(0.00),
                        ]),
                        Toggle::make('is_active')
                            ->label('Activo')
                            ->required()
                            ->default(true),
                    ]),

                Section::make('Facturación y Prueba')
                    ->description('Configuración de los períodos de cobro y prueba gratuita.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('invoice_period')
                                ->label('Período de Facturación')
                                ->required()
                                ->numeric()
                                ->default(1),
                            Select::make('invoice_interval')
                                ->label('Intervalo de Facturación')
                                ->required()
                                ->options([
                                    'day' => 'Día(s)',
                                    'week' => 'Semana(s)',
                                    'month' => 'Mes(es)',
                                    'year' => 'Año(s)',
                                ])
                                ->default('month'),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('trial_period')
                                ->label('Período de Prueba')
                                ->required()
                                ->numeric()
                                ->default(0),
                            Select::make('trial_interval')
                                ->label('Intervalo de Prueba')
                                ->required()
                                ->options([
                                    'day' => 'Día(s)',
                                    'week' => 'Semana(s)',
                                    'month' => 'Mes(es)',
                                ])
                                ->default('day'),
                        ]),
                    ]),
            ]);
    }
}
