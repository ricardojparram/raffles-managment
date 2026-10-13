<?php

namespace App\Filament\Superadmin\Resources\SubscriptionPayments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class SubscriptionPaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('team.name')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('plan.name')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('amount')
                    ->money(fn ($record) => $record->currency)
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\Action::make('approve')
                    ->label('Aprobar')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update(['status' => 'confirmed']);
                        $record->team->subscribe($record->plan);
                        \Filament\Notifications\Notification::make()
                            ->title('Pago aprobado y suscripción activada')
                            ->success()
                            ->send();
                    }),
                \Filament\Actions\Action::make('reject')
                    ->label('Rechazar')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update(['status' => 'rejected']);
                        \Filament\Notifications\Notification::make()
                            ->title('Pago rechazado')
                            ->danger()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
