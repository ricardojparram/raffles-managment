<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
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
    protected static ?string $slug = 'payments';

    public static function getLabel(): ?string
    {
        return __('Payment');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Payments');
    }

    public static function getNavigationLabel(): string
    {
        return __('Payments');
    }

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make(__('Payment Context'))
                    ->schema([
                        Select::make('customer_id')
                            ->relationship(name: 'customer')
                            ->getOptionLabelFromRecordUsing(fn(Customer $record) => "{$record->dni} - {$record->fullname}")
                            ->preload()
                            ->searchable(['dni', 'fullname'])
                            ->required()
                            ->label(__('Customer'))
                            ->native(false)
                            ->createOptionForm([
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
                            ])
                            ->editOptionForm([
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
                            ]),
                        Select::make('raffle_id')
                            ->relationship(name: 'raffle', modifyQueryUsing: fn($query) => $query->orderBy('date', 'desc'))
                            ->getOptionLabelFromRecordUsing(fn(Raffle $record) => $record->title)
                            ->required()
                            ->label(__('Raffle')),
                    ])->columns(2),
                    Section::make(__('Proof of Payment'))
                        ->schema([
                            FileUpload::make('img')
                                ->label(__('Image'))
                                ->image()
                                ->imageEditor()
                                ->directory(fn () => 'tenant-' . Filament::getTenant()->id . '/payments')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 1]),

                Group::make()->schema([
                    Section::make(__('Payment Details'))
                    ->schema([
                        Select::make('payment_method_id')
                            ->relationship(name: 'paymentMethod')
                            ->getOptionLabelFromRecordUsing(fn(PaymentMethod $record) => $record->title)
                            ->preload()
                            ->required()
                            ->label(__('Payment Method'))
                            ->live()
                            ->afterStateUpdated(function (\Filament\Schemas\Components\Utilities\Set $set, $state) {
                                if ($state) {
                                    $pm = \App\Models\PaymentMethod::find($state);
                                    if ($pm) {
                                        $set('currency', $pm->currency);
                                    }
                                }
                            }),
                        Hidden::make('currency')
                            ->default('USD')
                            ->dehydrated(),
                        TextInput::make('amount')
                            ->label(__('Amount'))
                            ->required()
                            ->prefix(function (\Filament\Schemas\Components\Utilities\Get $get) {
                                $c = $get('currency') ?? 'USD';
                                $flags = ['USD' => '🇺🇸', 'VED' => '🇻🇪'];
                                $symbols = ['USD' => '$', 'VED' => 'Bs.'];
                                return trim(($flags[$c] ?? '') . ' ' . $c . ' ' . ($symbols[$c] ?? ''));
                            })
                            ->currencyMask(',', '.', 2)
                            ->maxLength(255),
                        TextInput::make('reference')
                            ->label(__('Reference'))
                            ->required()
                            ->maxLength(255),
                        DateTimePicker::make('payment_date')
                            ->label(__('Payment Date'))
                            ->required()
                            ->seconds(false)
                            ->native(false)
                            ->placeholder(__('Select payment date')),
                        Select::make('status')
                            ->options(Payment::statusOptions())
                            ->label(__('Status'))
                            ->default(Payment::PENDING_STATUS)
                            ->required(),
                    ])->columns(2),
                ])->columnSpan(['lg' => 1]),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('raffle.title')->sortable()->searchable()->label(__('Raffle')),
                TextColumn::make('customer.fullname')->sortable()->searchable()->label(__('Customer')),
                TextColumn::make('paymentMethod.title')->sortable()->searchable()->label(__('Payment Method')),
                TextColumn::make('amount')
                    ->sortable()
                    ->searchable()
                    ->label(__('Amount'))
                    ->currency(fn ($record) => $record->currency ?? 'USD'),
                TextColumn::make('reference')->sortable()->searchable()->label(__('Reference')),
                IconSelectColumn::make('status')
                    ->options(PaymentStatus::class)
                    ->size(IconSize::Large),

                TextColumn::make('payment_date')
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable()
                    ->label(__('Payment Date')),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['raffle', 'customer', 'paymentMethod']);
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
