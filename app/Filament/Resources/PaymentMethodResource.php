<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\PaymentMethodResource\Pages\ListPaymentMethods;
use App\Filament\Resources\PaymentMethodResource\Pages\CreatePaymentMethod;
use App\Filament\Resources\PaymentMethodResource\Pages\EditPaymentMethod;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\PaymentMethod;
use Filament\Resources\Resource;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Infolists\Components\KeyValueEntry;
use App\Filament\Resources\PaymentMethodResource\Pages;
use App\Filament\Resources\PaymentMethodResource\RelationManagers;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;

    protected static ?string $slug = 'metodos-de-pago';
    protected static ?string $label = "metodo de pago";
    protected static ?string $pluralLabel = "metodos de pago";

    protected static ?string $navigationLabel = 'Metodos de pago';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nombre')
                    ->rules(['required', 'string', 'max:255'])
                    ->markAsRequired(),

                FileUpload::make('icon')
                    ->required('El icono es requerido')
                    ->label('Icono')
                    ->image()
                    ->imageEditor(),
                KeyValue::make('description')
                    ->label('Descripción')
                    ->required()
                    ->keyLabel('Titulo')
                    ->keyPlaceholder('Ej: Correo')
                    ->valueLabel('Descripción')
                    ->valuePlaceholder('ejemplo@gmail.com')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')
                    ->label('Icono')
                    ->size(50),
                TextColumn::make('title')->label('Titulo')->searchable()->sortable()->description(function ($record) {
                    return $record->description ? collect($record->description)->map(fn($value, $key) => "$key: $value")->join(', ') : null;
                }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListPaymentMethods::route('/'),
            'create' => CreatePaymentMethod::route('/create'),
            'edit' => EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
