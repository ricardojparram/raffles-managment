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
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\KeyValueEntry;
use App\Filament\Resources\PaymentMethodResource\Pages;
use App\Filament\Resources\PaymentMethodResource\RelationManagers;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;

    protected static ?string $slug = 'payment-methods';

    public static function getLabel(): ?string
    {
        return __('Payment Method');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Payment Methods');
    }

    public static function getNavigationLabel(): string
    {
        return __('Payment Methods');
    }

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('General Information'))
                    ->description(__('Configure the basic settings for this payment method.'))
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('Name'))
                                    ->placeholder(__('e.g. Zelle, Pago Móvil, Binance'))
                                    ->rules(['required', 'string', 'max:255'])
                                    ->markAsRequired(),
                                Select::make('currency')
                                    ->label(__('Currency'))
                                    ->options(function () {
                                        $flags = ['USD' => '🇺🇸', 'VED' => '🇻🇪'];
                                        return collect(\Akaunting\Money\Currency::getCurrencies())
                                            ->filter(fn($c, $k) => in_array($k, ['USD', 'VED']))
                                            ->mapWithKeys(function ($c, $k) use ($flags) {
                                                return [$k => "{$c['name']} {$flags[$k]} {$k} - {$c['symbol']}"];
                                            })
                                            ->toArray();
                                    })
                                    ->searchable()
                                    ->required()
                                    ->default('USD'),
                            ]),

                        FileUpload::make('icon')
                            ->required('El icono es requerido')
                            ->label(__('Icon'))
                            ->image()
                            ->imageEditor()
                            ->directory('payment-methods')
                            ->columnSpanFull(),
                    ]),

                Section::make(__('Payment Instructions'))
                    ->description(__('Add the necessary data to make the payment (e.g. Email, Phone, ID).'))
                    ->icon('heroicon-o-clipboard-document-list')
                    ->schema([
                        KeyValue::make('description')
                            ->label(__('Details'))
                            ->required()
                            ->keyLabel(__('Field (e.g. Email)'))
                            ->keyPlaceholder('Ej: Correo')
                            ->valueLabel(__('Value'))
                            ->valuePlaceholder('ejemplo@gmail.com')
                            ->addActionLabel(__('Add row'))
                            ->reorderable()
                            ->columnSpanFull()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')
                    ->label(__('Icon'))
                    ->size(50),
                TextColumn::make('title')->label(__('Title'))->searchable()->sortable()->description(function ($record) {
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
