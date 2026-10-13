<?php

namespace App\Filament\Superadmin\Resources\SubscriptionPayments\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class SubscriptionPaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Pago')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('team_id')
                                ->label('Organización')
                                ->relationship('team', 'name')
                                ->searchable()
                                ->required(),
                            Select::make('plan_id')
                                ->label('Plan Solicitado')
                                ->relationship('plan', 'name')
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('amount')
                                ->label('Monto')
                                ->required()
                                ->numeric()
                                ->prefix('$'),
                            TextInput::make('currency')
                                ->label('Moneda')
                                ->required()
                                ->default('USD'),
                        ]),
                    ]),

                Section::make('Detalles de Transacción')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('payment_method')
                                ->label('Método de Pago')
                                ->required(),
                            TextInput::make('reference')
                                ->label('Referencia'),
                            Select::make('status')
                                ->label('Estado')
                                ->options([
                                    'pending' => 'Pendiente',
                                    'confirmed' => 'Confirmado',
                                    'rejected' => 'Rechazado',
                                ])
                                ->required()
                                ->default('pending'),
                        ]),
                        FileUpload::make('receipt_image')
                            ->label('Comprobante de Pago')
                            ->image()
                            ->directory('receipts')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
