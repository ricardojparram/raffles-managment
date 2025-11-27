<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\PaymentResource\Pages\ListPayments;
use App\Filament\Resources\PaymentResource\Pages\CreatePayment;
use App\Filament\Resources\PaymentResource\Pages\EditPayment;
use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Customer;
use App\Models\Raffle;
use App\Models\PaymentMethod;
use Filament\Facades\Filament;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use Filament\Support\Enums\IconSize;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Multitenancy\Models\Tenant;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $slug = 'pagos';
    protected static ?string $label = "pago";
    protected static ?string $pluralLabel = "pagos";

    protected static ?string $navigationLabel = 'Pagos';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';
    protected static bool $isScopedToTenant = false; // Desactivar filtrado automático
    // protected static ?string $tenantRelationshipName = 'raffle';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship(name: 'customer')
                    ->getOptionLabelFromRecordUsing(fn(Customer $record) => "{$record->dni} - {$record->fullname}")
                    ->preload()
                    ->searchable(['dni', 'fullname'])
                    ->required()
                    ->label('Cliente')
                    ->native(false)
                    ->createOptionForm([
                        TextInput::make('dni')
                            ->label('Identificación')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('lastname')
                            ->label('Apellido')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->required()
                            ->tel()
                            ->prefix('+58')
                            ->maxLength(12),
                    ])
                    ->editOptionForm([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('lastname')
                            ->label('Apellido')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->required()
                            ->tel()
                            ->prefix('+58')
                            ->maxLength(12),
                    ]),
                TextInput::make('amount')
                    ->label('Monto')
                    ->required()
                    ->prefix('$')
                    ->maxLength(255),
                Select::make('status')
                    ->options(Payment::statusOptions())
                    ->label('Estado')
                    ->default(Payment::PENDING_STATUS)
                    ->required(),
                DateTimePicker::make('payment_date')
                    ->label('Fecha de pago')
                    ->required()
                    ->seconds(false)
                    ->native(false)
                    ->placeholder('Selecciona la fecha de pago'),
                Select::make('raffle_id')
                    ->relationship(name: 'raffle', modifyQueryUsing: fn($query) => $query->orderBy('date', 'desc'))
                    ->getOptionLabelFromRecordUsing(fn(Raffle $record) => $record->title)
                    ->required()
                    ->label('Rifa'),
                Select::make('payment_method_id')
                    ->relationship(name: 'paymentMethod')
                    ->getOptionLabelFromRecordUsing(fn(PaymentMethod $record) => $record->title)
                    ->preload()
                    ->required()
                    ->label('Método de pago'),
                TextInput::make('reference')
                    ->label('Referencia')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('img')
                    ->label('Imagen')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('raffle.title')->sortable()->searchable()->label('Rifa'),
                TextColumn::make('customer.fullname')->sortable()->searchable()->label('Cliente'),
                TextColumn::make('paymentMethod.title')->sortable()->searchable()->label('Método de pago'),
                TextColumn::make('amount')->sortable()->searchable()->label('Monto'),
                TextColumn::make('reference')->sortable()->searchable()->label('Referencia'),
                IconSelectColumn::make('status')
                    ->options(PaymentStatus::class)
                    ->size(IconSize::Large),

                TextColumn::make('payment_date')
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable()
                    ->label('Fecha de pago'),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->whereHas('raffle', fn($query) => $query->where('team_id', Filament::getTenant()->getKey()));
            })
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
            'index' => ListPayments::route('/'),
            'create' => CreatePayment::route('/create'),
            'edit' => EditPayment::route('/{record}/edit'),
        ];
    }
}
