<?php

namespace App\Filament\Resources;

use Akaunting\Money\Currency;
use App\Enums\Status;
use App\Filament\Resources\RaffleResource\Pages\CreateRaffle;
use App\Filament\Resources\RaffleResource\Pages\EditRaffle;
use App\Filament\Resources\RaffleResource\Pages\ListRaffles;
use App\Filament\Schemas\Components\MoneyInput;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Raffle;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Js;
use Illuminate\Support\Str;

class RaffleResource extends Resource
{
    protected static ?string $model = Raffle::class;

    protected static ?string $slug = 'raffles';

    public static function getLabel(): ?string
    {
        return __('Raffle');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Raffles');
    }

    public static function getNavigationLabel(): string
    {
        return __('Raffles');
    }

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-gift';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make(__('Raffle Details'))
                        ->columns(['default' => 1, 'md' => 2])
                        ->schema([
                            TextInput::make('title')
                                ->label(__('Title'))
                                ->rules(['required', 'string', 'max:255'])
                                ->markAsRequired()
                                ->maxLength(255),
                            DateTimePicker::make('date')
                                ->required()
                                ->seconds(false)
                                ->native(false)
                                ->label(__('Raffle Date'))
                                ->placeholder(__('Select raffle date')),
                            Select::make('currency')
                                ->label(__('Currency'))
                                ->options(function () {
                                    $flags = ['USD' => '🇺🇸', 'VED' => '🇻🇪'];

                                    return collect(Currency::getCurrencies())
                                        ->filter(fn ($c, $k) => in_array($k, ['USD', 'VED']))
                                        ->mapWithKeys(function ($c, $k) use ($flags) {
                                            return [$k => "{$flags[$k]} {$k} - {$c['name']}"];
                                        })
                                        ->toArray();
                                })
                                ->searchable()
                                ->required()
                                ->live()
                                ->default('USD'),
                            MoneyInput::make('ticket_price')
                                ->rules(['required'])
                                ->markAsRequired()
                                ->label(__('Ticket Price'))
                                ->prefix(function (Get $get) {
                                    $c = $get('currency') ?? 'USD';
                                    $flags = ['USD' => '🇺🇸', 'VED' => '🇻🇪'];
                                    $symbols = ['USD' => '$', 'VED' => 'Bs.'];

                                    return trim(($flags[$c] ?? '').' '.$c.' '.($symbols[$c] ?? ''));
                                }),
                            TextInput::make('ticket_amount')
                                ->label(__('Ticket amount'))
                                ->helperText(__('Numbers start at 00. This cannot change once a number is taken.'))
                                ->integer()
                                ->required()
                                ->minValue(2)
                                ->maxValue(100000)
                                ->default(100)
                                ->disabled(fn (?Raffle $record): bool => (bool) $record?->tickets()->exists()),
                            TextInput::make('minimum_tickets')
                                ->label(__('Minimum tickets per purchase'))
                                ->integer()
                                ->required()
                                ->minValue(1)
                                ->lte('ticket_amount')
                                ->default(1),
                            TextInput::make('conalot_permit')
                                ->label(__('CONALOT Authorization'))
                                ->placeholder('Ej. CONALOT-RIFA-2026-001')
                                ->maxLength(255)
                                ->helperText(__('Permit or authorization issued by CONALOT for this raffle.')),
                            Select::make('status')
                                ->label(__('Status'))
                                ->options(Status::class)
                                ->default(Status::Active->value)
                                ->required()
                                ->live(),
                            TextInput::make('winning_number')
                                ->label(__('Winning number(s)'))
                                ->placeholder('Ej. 013 o 013, 275')
                                ->maxLength(255)
                                ->helperText(__('Ticket number(s) that won the main prize.')),

                            FileUpload::make('img')
                                ->required()
                                ->label(__('Image'))
                                ->image()
                                ->imageEditor()
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                ->disk('public')
                                ->visibility('public')
                                ->directory(fn () => 'tenant-'.Filament::getTenant()->id.'/raffles')
                                ->columnSpanFull(),
                            RichEditor::make('description')
                                ->required()
                                ->label(__('Description'))
                                ->placeholder(__('Write a description of the raffle'))
                                ->columnSpanFull(),
                        ]),
                    Grid::make(1)->schema([
                        Section::make(__('Prizes'))->description(__('Indicate the prizes in addition to the main prize'))->schema([
                            Repeater::make('raffle_prizes')
                                ->label('')
                                ->relationship()
                                ->collapsed()
                                ->addActionLabel(__('Add prize'))
                                ->addActionAlignment(Alignment::End)
                                ->itemLabel(function (array $state): ?string {
                                    $date = isset($state['date']) ? date('d/m/y h:i a', strtotime($state['date'])) : null;
                                    $name = $state['title'] ?? null;
                                    $name .= $date ? " el $date" : null;

                                    return $name;
                                })
                                ->live(true)
                                ->schema([
                                    TextInput::make('title')
                                        ->label(__('Title'))
                                        ->rules(['string', 'max:255'])
                                        ->maxLength(255),
                                    DateTimePicker::make('date')
                                        ->rules(['date'])
                                        ->seconds(false)
                                        ->native(false)
                                        ->label(__('Raffle Date'))
                                        ->placeholder(__('Select raffle date')),
                                    FileUpload::make('img')
                                        ->label(__('Image'))
                                        ->image()
                                        ->imageEditor()
                                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                        ->disk('public')
                                        ->visibility('public')
                                        ->directory(fn () => 'tenant-'.Filament::getTenant()->id.'/prizes'),
                                    TextInput::make('winning_number')
                                        ->label(__('Número ganador'))
                                        ->placeholder('Ej. 275')
                                        ->maxLength(255),
                                ]),
                        ]),
                        Section::make(__('Offers'))->description(__('Offers or discounts for tickets'))->schema([
                            Repeater::make('offers')
                                ->label('')
                                ->relationship()
                                ->collapsed()
                                ->addActionLabel(__('Add offer'))
                                ->addActionAlignment(Alignment::End)
                                ->reorderableWithButtons()
                                ->itemLabel(fn (array $state): ?string => isset($state['ticket_amount'], $state['price']) ? $state['ticket_amount'].' tickets' : null)
                                ->live(true)
                                ->schema([
                                    Group::make()->columns(2)->schema([
                                        TextInput::make('ticket_amount')
                                            ->label(__('Ticket amount'))
                                            ->rules(['numeric'])
                                            ->maxLength(255),
                                        MoneyInput::make('price')
                                            ->rules(['required'])
                                            ->label(__('Amount')),
                                    ]),
                                ]),
                        ]),
                    ])->grow(false),
                ])->from('md')->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img')
                    ->label(__('Image'))
                    ->disk('public')
                    ->size(50),
                TextColumn::make('title')->label(__('Raffle Details'))->searchable()->sortable()->description(function ($record) {
                    return Str::words(strip_tags($record->description), 8, '...');
                }),
                TextColumn::make('date')
                    ->label(__('Raffle Date'))
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/y h:i a')
                    ->limit(50),
                TextColumn::make('ticket_price')
                    ->label(__('Ticket Price'))
                    ->sortable()
                    ->searchable()
                    ->currency(fn ($record) => $record->currency ?? 'USD')
                    ->limit(50),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Status::Active->value => 'success',
                        Status::Finished->value => 'gray',
                        Status::Canceled->value => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        Status::Active->value => __('Active'),
                        Status::Finished->value => __('Finished'),
                        Status::Canceled->value => __('Canceled'),
                        default => __('Draft'),
                    }),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('registerSale')
                    ->label(__('Register Sale'))
                    ->icon('heroicon-o-ticket')
                    ->color('success')
                    ->visible(fn (Raffle $record): bool => (auth()->user()?->canSellFor(Filament::getTenant()) ?? false) && $record->salesStatus()->isOpen())
                    ->form([
                        Select::make('customer_id')
                            ->label(__('Customer'))
                            ->options(fn () => Filament::getTenant()?->customers()->pluck('name', 'id') ?? [])
                            ->getOptionLabelFromRecordUsing(fn (Customer $record) => "{$record->dni} - {$record->fullname}")
                            ->searchable()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('dni')->label(__('Identity Card'))->required()->maxLength(255),
                                TextInput::make('name')->label(__('Name'))->required()->maxLength(255),
                                TextInput::make('lastname')->label(__('Last Name'))->required()->maxLength(255),
                                TextInput::make('phone')->label(__('Phone'))->required()->tel()->maxLength(255),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return Filament::getTenant()->customers()->create($data)->id;
                            }),
                        Select::make('payment_method_id')
                            ->label(__('Payment Method'))
                            ->options(fn () => Filament::getTenant()?->paymentMethods()->pluck('title', 'id') ?? [])
                            ->required(),
                        TextInput::make('quantity')
                            ->label(__('Ticket Quantity'))
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->maxValue(fn (Raffle $record) => max(1, $record->availableTicketsCount()))
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, Raffle $record, $state) {
                                if ($state && is_numeric($state)) {
                                    $set('amount', $record->priceForQuantity((int) $state));
                                }
                            }),
                        TextInput::make('amount')
                            ->label(__('Amount in cents'))
                            ->numeric()
                            ->default(fn (Raffle $record) => $record->ticket_price)
                            ->required(),
                        TextInput::make('reference')
                            ->label(__('Reference'))
                            ->placeholder(__('Cash / POS / Reference number'))
                            ->default('Venta manual')
                            ->maxLength(255),
                    ])
                    ->action(function (array $data, Raffle $record) {
                        $quantity = (int) $data['quantity'];
                        $numbers = $record->randomAvailableNumbers($quantity);

                        if (count($numbers) < $quantity) {
                            Notification::make()
                                ->title(__('Not enough tickets available'))
                                ->danger()
                                ->send();

                            return;
                        }

                        DB::transaction(function () use ($data, $record, $numbers) {
                            $payment = Payment::create([
                                'team_id' => $record->team_id,
                                'customer_id' => $data['customer_id'],
                                'raffle_id' => $record->id,
                                'payment_method_id' => $data['payment_method_id'],
                                'amount' => (int) $data['amount'],
                                'currency' => $record->currency,
                                'status' => Payment::CONFIRMED_STATUS,
                                'reviewed_by' => auth()->id(),
                                'reviewed_at' => now(),
                                'payment_date' => now(),
                                'reference' => $data['reference'] ?? 'Venta manual',
                            ]);

                            $payment->tickets()->createMany(array_map(fn ($num) => [
                                'raffle_id' => $record->id,
                                'customer_id' => $data['customer_id'],
                                'number' => $num,
                            ], $numbers));
                        });

                        Notification::make()
                            ->title(__('Sale registered successfully'))
                            ->body(__('Assigned numbers: :numbers', ['numbers' => implode(', ', $numbers)]))
                            ->success()
                            ->send();
                    }),
                Action::make('declareWinners')
                    ->label(__('Registrar Ganadores'))
                    ->icon('heroicon-o-trophy')
                    ->color('warning')
                    ->modalHeading(__('Registrar números ganadores'))
                    ->form([
                        TextInput::make('winning_number')
                            ->label(__('Número ganador (Premio principal)'))
                            ->placeholder('Ej. 013 o 013, 275')
                            ->helperText(__('Separá con comas si son varios ganadores.'))
                            ->required(),
                        Select::make('status')
                            ->label(__('Estado de la rifa'))
                            ->options([
                                Status::Finished->value => __('Finalizado'),
                                Status::Active->value => __('Activo'),
                            ])
                            ->default(Status::Finished->value)
                            ->required(),
                    ])
                    ->fillForm(fn (Raffle $record): array => [
                        'winning_number' => $record->winning_number,
                        'status' => $record->status ?? Status::Finished->value,
                    ])
                    ->action(function (array $data, Raffle $record): void {
                        $record->update([
                            'winning_number' => $data['winning_number'],
                            'status' => $data['status'],
                        ]);

                        Notification::make()
                            ->title(__('Números ganadores actualizados'))
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
                ViewAction::make()->modalWidth(Width::ScreenExtraLarge),
                ActionGroup::make([
                    Action::make('publicPage')
                        ->label(__('Public page'))
                        ->icon('heroicon-o-arrow-top-right-on-square')
                        ->url(fn (Raffle $record): string => $record->publicUrl(), shouldOpenInNewTab: true)
                        ->visible(fn (Raffle $record): bool => $record->status !== Status::Pending->value),
                    Action::make('copyPublicLink')
                        ->label(__('Copy link'))
                        ->icon('heroicon-o-link')
                        ->alpineClickHandler(fn (Raffle $record): string => sprintf(
                            'window.navigator.clipboard.writeText(%s); $tooltip(%s, { timeout: 1500 })',
                            Js::from($record->publicUrl()),
                            Js::from(__('Link copied')),
                        ))
                        ->visible(fn (Raffle $record): bool => $record->status !== Status::Pending->value),
                ])
                    ->label(__('Share'))
                    ->icon('heroicon-o-share')
                    ->color('gray')
                    ->tooltip(__('Share')),
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
            'index' => ListRaffles::route('/'),
            'create' => CreateRaffle::route('/create'),
            'edit' => EditRaffle::route('/{record}/edit'),
        ];
    }
}
