<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Customer;
use App\Models\Raffle;
use App\Models\PaymentMethod;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship(name: 'customer')
                    ->getOptionLabelFromRecordUsing(fn(Customer $record) => "{$record->dni} - {$record->fullname}")
                    ->searchable(['dni', 'fullname'])
                    ->required()
                    ->label('Cliente')
                    ->native(false)
                    ->createOptionForm([
                        Forms\Components\TextInput::make('dni')
                            ->label('Identificación')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('lastname')
                            ->label('Apellido')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Teléfono')
                            ->required()
                            ->tel()
                            ->prefix('+58')
                            ->maxLength(12),
                    ])
                    ->editOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('lastname')
                            ->label('Apellido')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Teléfono')
                            ->required()
                            ->tel()
                            ->prefix('+58')
                            ->maxLength(12),
                    ]),
                Forms\Components\TextInput::make('amount')
                    ->label('Monto')
                    ->required()
                    ->prefix('$')
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options(Payment::statusOptions())
                    ->label('Estado')
                    ->default(Payment::PENDING_STATUS)
                    ->required(),
                Forms\Components\DateTimePicker::make('payment_date')
                    ->label('Fecha de pago')
                    ->required()
                    ->seconds(false)
                    ->native(false)
                    ->placeholder('Selecciona la fecha de pago'),
                Forms\Components\Select::make('raffle_id')
                    ->relationship(name: 'raffle', modifyQueryUsing: fn($query) => $query->orderBy('date', 'desc'))
                    ->getOptionLabelFromRecordUsing(fn(Raffle $record) => $record->title)
                    ->required()
                    ->label('Rifa'),
                Forms\Components\Select::make('payment_method_id')
                    ->relationship(name: 'paymentMethod')
                    ->getOptionLabelFromRecordUsing(fn(PaymentMethod $record) => $record->title)
                    ->preload()
                    ->required()
                    ->label('Método de pago'),
                Forms\Components\TextInput::make('reference')
                    ->label('Referencia')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('img')
                    ->label('Imagen')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('raffle.title')->sortable()->searchable()->label('Rifa'),
                TextColumn::make('customer.fullname')->sortable()->searchable()->label('Cliente'),
                TextColumn::make('paymentMethod.title')->sortable()->searchable()->label('Método de pago'),
                TextColumn::make('amount')->sortable()->searchable()->label('Monto'),
                TextColumn::make('reference')->sortable()->searchable()->label('Referencia'),
                IconSelectColumn::make('status')
                    ->options(PaymentStatus::class)
                    ->closeOnSelection(),
                TextColumn::make('payment_date')
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable()
                    ->label('Fecha de pago'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
