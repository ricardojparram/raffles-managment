<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\CustomerResource\Pages\ListCustomers;
use App\Filament\Resources\CustomerResource\Pages\CreateCustomer;
use App\Filament\Resources\CustomerResource\Pages\EditCustomer;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $slug = 'customers';

    public static function getLabel(): ?string
    {
        return __('Customer');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Customers');
    }

    public static function getNavigationLabel(): string
    {
        return __('Customers');
    }

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('dni')
                    ->label(__('Identity Card'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('lastname')
                    ->label(__('Last Name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label(__('Phone'))
                    ->required()
                    ->tel()
                    ->prefix('+58')
                    ->maxLength(12),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('dni')
                    ->sortable()
                    ->searchable()
                    ->label(__('Identity Card')),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(__('Name')),
                TextColumn::make('lastname')
                    ->sortable()
                    ->searchable()
                    ->label(__('Last Name')),
                TextColumn::make('phone')
                    ->sortable()
                    ->searchable()
                    ->label(__('Phone')),
            ])
            ->filters([])
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
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'edit' => EditCustomer::route('/{record}/edit'),
        ];
    }
}
