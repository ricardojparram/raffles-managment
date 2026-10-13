<?php

namespace App\Filament\Superadmin\Resources\Users\Pages;

use App\Filament\Superadmin\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        if ($this->record->hasRole('super_admin') && auth()->id() !== $this->record->id) {
            \Filament\Notifications\Notification::make()
                ->danger()
                ->title('Acceso denegado')
                ->body('No puedes editar a otro super admin.')
                ->send();

            $this->redirect($this->getResource()::getUrl('index'));
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
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
                ->hidden(fn ($record) => $record->hasRole('super_admin')),
        ];
    }
}
