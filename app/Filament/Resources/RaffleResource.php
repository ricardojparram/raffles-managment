<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Width;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\RaffleResource\Pages\ListRaffles;
use App\Filament\Resources\RaffleResource\Pages\CreateRaffle;
use App\Filament\Resources\RaffleResource\Pages\EditRaffle;
use Filament\Tables;
use App\Enums\Status;
use App\Models\Raffle;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\RaffleResource\Pages;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use Filament\Support\Enums\IconSize;
use Filament\Facades\Filament;

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
                                    return collect(\Akaunting\Money\Currency::getCurrencies())
                                        ->filter(fn($c, $k) => in_array($k, ['USD', 'VED']))
                                        ->mapWithKeys(function ($c, $k) use ($flags) {
                                            return [$k => "{$flags[$k]} {$k} - {$c['name']}"];
                                        })
                                        ->toArray();
                                })
                                ->searchable()
                                ->required()
                                ->live()
                                ->default('USD'),
                            TextInput::make('ticket_price')
                                ->rules(['required'])
                                ->markAsRequired()
                                ->label(__('Ticket Price'))
                                ->prefix(function (\Filament\Schemas\Components\Utilities\Get $get) {
                                    $c = $get('currency') ?? 'USD';
                                    $flags = ['USD' => '🇺🇸', 'VED' => '🇻🇪'];
                                    $symbols = ['USD' => '$', 'VED' => 'Bs.'];
                                    return trim(($flags[$c] ?? '') . ' ' . $c . ' ' . ($symbols[$c] ?? ''));
                                })
                                ->currencyMask(',', '.', 2),

                            FileUpload::make('img')
                                ->required()
                                ->label(__('Image'))
                                ->image()
                                ->imageEditor()
                                ->directory(fn () => 'tenant-' . Filament::getTenant()->id . '/raffles')
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
                                        ->directory(fn () => 'tenant-' . Filament::getTenant()->id . '/prizes')
                                ])
                        ]),
                        Section::make(__('Offers'))->description(__('Offers or discounts for tickets'))->schema([
                            Repeater::make('offers')
                                ->label('')
                                ->relationship()
                                ->collapsed()
                                ->addActionLabel(__('Add offer'))
                                ->addActionAlignment(Alignment::End)
                                ->reorderableWithButtons()
                                ->itemLabel(fn(array $state): ?string => isset($state['ticket_amount'], $state['price']) ? $state['ticket_amount'] . " tickets" : null)
                                ->live(true)
                                ->schema([
                                    Group::make()->columns(2)->schema([
                                        TextInput::make('ticket_amount')
                                            ->label(__('Ticket amount'))
                                            ->rules(['numeric'])
                                            ->maxLength(255),
                                        TextInput::make('price')
                                            ->rules(['required'])
                                            ->label(__('Amount'))
                                            ->currencyMask(',', '.', 2),
                                    ]),
                                ])
                        ])
                    ])->grow(false)
                ])->from('md')->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img')
                    ->label(__('Image'))
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
                    ->currency(fn($record) => $record->currency ?? 'USD')
                    ->limit(50),
                IconSelectColumn::make('status')
                    ->options(Status::class)
                    ->size(IconSize::Large),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make()->modalWidth(Width::ScreenExtraLarge)
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
