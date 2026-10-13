<?php

namespace App\Filament\Superadmin\Resources\Subscriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('subscriber_type')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('subscriber_id')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('plan.name')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('started_at')
                    ->dateTime()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('expired_at')
                    ->dateTime()
                    ->sortable(),
                \Filament\Tables\Columns\IconColumn::make('was_switched')
                    ->boolean(),
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
}
