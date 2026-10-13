<?php

namespace App\Filament\Superadmin\Resources\Plans;

use App\Filament\Superadmin\Resources\Plans\Pages\CreatePlan;
use App\Filament\Superadmin\Resources\Plans\Pages\EditPlan;
use App\Filament\Superadmin\Resources\Plans\Pages\ListPlans;
use App\Filament\Superadmin\Resources\Plans\Schemas\PlanForm;
use App\Filament\Superadmin\Resources\Plans\Tables\PlansTable;
use App\Models\Plan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PlanResource extends Resource
{
    protected static ?string $model = \Revoltify\Subscriptionify\Models\Plan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PlanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlansTable::configure($table);
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
            'index' => ListPlans::route('/'),
            'create' => CreatePlan::route('/create'),
            'edit' => EditPlan::route('/{record}/edit'),
        ];
    }
}
