<?php

namespace App\Filament\Superadmin\Resources\Users;

use App\Filament\Superadmin\Resources\Users\Pages\CreateUser;
use App\Filament\Superadmin\Resources\Users\Pages\EditUser;
use App\Filament\Superadmin\Resources\Users\Pages\ListUsers;
use App\Filament\Superadmin\Resources\Users\Schemas\UserForm;
use App\Filament\Superadmin\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table)
            ->actions([
                \STS\FilamentImpersonate\Actions\Impersonate::make()
                    ->guard('web')
                    ->redirectTo('/admin'),
                \Filament\Actions\EditAction::make()
                    ->hidden(fn (User $record): bool => $record->hasRole('super_admin') && auth()->id() !== $record->id),
                \Filament\Actions\DeleteAction::make()
                    ->before(function ($record, \Filament\Actions\DeleteAction $action) {
                        if ($record->hasRole('super_admin')) {
                            \Filament\Notifications\Notification::make()
                                ->danger()
                                ->title('Acción bloqueada')
                                ->body('No puedes eliminar al super_admin.')
                                ->send();

                            $action->halt();
                        }
                    })
                    ->hidden(fn (User $record): bool => $record->hasRole('super_admin')),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records, \Filament\Actions\DeleteBulkAction $action) {
                            $containsSuperAdmin = false;
                            $records->each(function ($record) use (&$containsSuperAdmin) {
                                if ($record->hasRole('super_admin')) {
                                    $containsSuperAdmin = true;
                                } else {
                                    $record->delete();
                                }
                            });

                            if ($containsSuperAdmin) {
                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Acción bloqueada parcialmente')
                                    ->body('No se pudieron eliminar los usuarios super_admin.')
                                    ->send();
                            }
                        }),
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
