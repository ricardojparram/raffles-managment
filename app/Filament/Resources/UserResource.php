<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';

    public static function getLabel(): ?string
    {
        return __('User');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Users');
    }

    public static function getNavigationLabel(): string
    {
        return __('Users');
    }

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $tenantOwnershipRelationshipName = 'teams';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('User Details'))
                    ->description(__('Provide the user\'s basic information.'))
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label(__('Name')),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->label(__('Email')),
                        TextInput::make('password')
                            ->password()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn (?string $state) => filled($state))
                            ->maxLength(255)
                            ->label(__('Password')),
                        \Filament\Forms\Components\Select::make('team_role')
                            ->label(__('Role'))
                            ->options([
                                \App\Enums\TeamRole::ADMIN->value => \App\Enums\TeamRole::ADMIN->label(),
                                \App\Enums\TeamRole::SELLER->value => \App\Enums\TeamRole::SELLER->label(),
                                \App\Enums\TeamRole::VIEWER->value => \App\Enums\TeamRole::VIEWER->label(),
                            ])
                            ->default(\App\Enums\TeamRole::SELLER->value)
                            ->required()
                            ->dehydrated(false)
                            ->disabled(fn (?User $record): bool => $record?->isOwnerOf() ?? false)
                            ->formatStateUsing(fn (?User $record): ?string => $record?->roleIn()?->value ?? \App\Enums\TeamRole::SELLER->value),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable()->label(__('Name')),
                TextColumn::make('email')->sortable()->searchable()->label(__('Email')),
                TextColumn::make('role')
                    ->label(__('Role'))
                    ->state(fn (User $record): string => $record->roleIn()?->label() ?? __('None'))
                    ->badge()
                    ->color(fn (User $record): string => match ($record->roleIn()) {
                        \App\Enums\TeamRole::OWNER => 'danger',
                        \App\Enums\TeamRole::ADMIN => 'warning',
                        \App\Enums\TeamRole::SELLER => 'success',
                        default => 'gray',
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
