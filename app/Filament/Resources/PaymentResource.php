<?php

namespace App\Filament\Resources;

use App\Actions\ReserveTickets;
use App\Enums\PaymentStatus;
use App\Filament\Resources\PaymentResource\Pages\CreatePayment;
use App\Filament\Resources\PaymentResource\Pages\EditPayment;
use App\Filament\Resources\PaymentResource\Pages\ListPayments;
use App\Filament\Schemas\Components\MoneyInput;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use Illuminate\Database\Eloquent\Builder;

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
                                ->getOptionLabelFromRecordUsing(fn (Customer $record) => "{$record->dni} - {$record->fullname}")
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
                                ->relationship(name: 'raffle', modifyQueryUsing: fn ($query) => $query->orderBy('date', 'desc'))
                                ->getOptionLabelFromRecordUsing(fn (Raffle $record) => $record->title)
                                ->required()
                                ->label(__('Raffle')),
                        ])->columns(2),
                    Section::make(__('Proof of Payment'))
                        ->schema([
                            FileUpload::make('img')
                                ->label(__('Image'))
                                ->image()
                                ->imageEditor()
                                ->disk(ReserveTickets::PROOF_DISK)
                                ->visibility('private')
                                ->directory(fn () => 'tenant-'.Filament::getTenant()->id.'/payments')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(['lg' => 1]),

                Group::make()->schema([
                    Section::make(__('Payment Details'))
                        ->schema([
                            Select::make('payment_method_id')
                                ->relationship(name: 'paymentMethod')
                                ->getOptionLabelFromRecordUsing(fn (PaymentMethod $record) => $record->title)
                                ->preload()
                                ->required()
                                ->label(__('Payment Method'))
                                ->live()
                                ->afterStateUpdated(function (Set $set, $state) {
                                    if ($state) {
                                        $pm = PaymentMethod::find($state);
                                        if ($pm) {
                                            $set('currency', $pm->currency);
                                        }
                                    }
                                }),
                            Hidden::make('currency')
                                ->default('USD')
                                ->dehydrated(),
                            MoneyInput::make('amount')
                                ->label(__('Amount'))
                                ->required()
                                ->prefix(function (Get $get) {
                                    $c = $get('currency') ?? 'USD';
                                    $flags = ['USD' => '🇺🇸', 'VED' => '🇻🇪'];
                                    $symbols = ['USD' => '$', 'VED' => 'Bs.'];

                                    return trim(($flags[$c] ?? '').' '.$c.' '.($symbols[$c] ?? ''));
                                })
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
                TextColumn::make('tickets.number')
                    ->label(__('Tickets'))
                    ->badge()
                    ->limitList(6),
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
        return parent::getEloquentQuery()->with(['raffle', 'customer', 'paymentMethod', 'tickets']);
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
