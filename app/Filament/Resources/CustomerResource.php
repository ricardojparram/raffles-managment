<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Filament\Schemas\Components\Section;
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
    use \App\Filament\Traits\EnforcesFeatureLimit;

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

    public static function canCreate(): bool
    {
        return static::checkFeatureLimit('customers');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Personal Information'))
                    ->description(__('Provide the customer\'s basic details and contact information.'))
                    ->icon('heroicon-o-identification')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-user')
                            ->placeholder('John'),
                        TextInput::make('lastname')
                            ->label(__('Last Name'))
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-user')
                            ->placeholder('Doe'),
                        TextInput::make('dni')
                            ->label(__('Identity Card'))
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-identification')
                            ->placeholder('12345678'),
                        PhoneInput::make('phone')
                            ->label(__('Phone'))
                            ->required()
                            ->defaultCountry('ve')
                            ->placeholder('412 123 4567'),
                    ])->columns(2),
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
