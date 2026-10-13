<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\Role;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    use \App\Filament\Traits\EnforcesFeatureLimit;

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

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $tenantOwnershipRelationshipName = 'teams';

    public static function canCreate(): bool
    {
        return static::checkFeatureLimit('team_members');
    }

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
                        Select::make('team_role')
                            ->label(__('Role'))
                            ->options(fn () => Role::whereNull('team_id')
                                ->where('name', '!=', 'super_admin')
                                ->pluck('name', 'name')
                                ->mapWithKeys(fn ($name, $key) => [$key => ucfirst($name)])
                            )
                            ->required()
                            ->default('seller')
                            ->afterStateHydrated(function (Select $component, ?User $record) {
                                if ($record) {
                                    $tenant = Filament::getTenant();
                                    if ($tenant) {
                                        setPermissionsTeamId($tenant->id);
                                        $role = $record->roles->first();
                                        $component->state($role?->name);
                                    }
                                }
                            })
                            ->dehydrated(false)
                            ->saveRelationshipsUsing(function (User $record, $state) {
                                $tenant = Filament::getTenant();
                                if ($tenant && $state) {
                                    setPermissionsTeamId($tenant->id);
                                    // The tenant association is automatically handled by Filament's CreateRecord/EditRecord,
                                    // but we can ensure it here just to be safe.
                                    $record->teams()->syncWithoutDetaching([$tenant->id]);
                                    $record->syncRoles([$state]);
                                }
                            }),
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
                TextColumn::make('roles.name')
                    ->label(__('Role'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
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
