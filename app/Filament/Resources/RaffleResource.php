<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Flex;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\RaffleResource\Pages;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;
use Filament\Support\Enums\IconSize;

class RaffleResource extends Resource
{
    protected static ?string $model = Raffle::class;

    protected static ?string $slug = 'rifas';
    protected static ?string $label = "rifa";
    protected static ?string $pluralLabel = "rifas";

    protected static ?string $navigationLabel = 'Rifas';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-gift';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make('Datos de la rifa')
                        ->columns(['default' => 1, 'lg' => 3])
                        ->schema([
                            TextInput::make('title')
                                ->label('Titulo')
                                ->rules(['required', 'string', 'max:255'])
                                ->markAsRequired()
                                ->maxLength(255),
                            DateTimePicker::make('date')
                                ->required()
                                ->seconds(false)
                                ->native(false)
                                ->label('Fecha de la rifa')
                                ->placeholder('Selecciona la fecha de la rifa'),
                            TextInput::make('ticket_price')
                                ->rules(['required', 'numeric'])
                                ->markAsRequired()
                                ->label('Precio del ticket')
                                ->numeric()
                                ->minValue(1)
                                ->prefix('$'),

                            FileUpload::make('img')
                                ->required()
                                ->label('Imagen')
                                ->image()
                                ->imageEditor()
                                ->columnSpanFull(),
                            RichEditor::make('description')
                                ->required()
                                ->label('Descripción de la rifa')
                                ->placeholder('Escribe una descripción de la rifa')
                                ->columnSpanFull(),
                        ]),
                    Grid::make(1)->schema([
                        Section::make('Premios')->description('Indica los premios además del premio principal')->schema([
                            Repeater::make('raffle_prizes')
                                ->label('')
                                ->relationship()
                                ->collapsed()
                                ->addActionLabel('Agregar premio')
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
                                        ->label('Titulo')
                                        ->rules(['string', 'max:255'])
                                        ->maxLength(255),
                                    DateTimePicker::make('date')
                                        ->rules(['date'])
                                        ->seconds(false)
                                        ->native(false)
                                        ->label('Fecha de la rifa')
                                        ->placeholder('Selecciona la fecha de la rifa'),
                                    FileUpload::make('img')
                                        ->label('Imagen')
                                        ->image()
                                        ->imageEditor()
                                ])
                        ]),
                        Section::make('Ofertas')->description('Ofertas o descuentos por tickets')->schema([
                            Repeater::make('offers')
                                ->label('')
                                ->relationship()
                                ->collapsed()
                                ->addActionLabel('Agregar oferta')
                                ->addActionAlignment(Alignment::End)
                                ->reorderableWithButtons()
                                ->itemLabel(fn(array $state): ?string => isset($state['ticket_amount'], $state['price']) ? $state['ticket_amount'] . " tickets x $" . $state['price'] : null)
                                ->live(true)
                                ->schema([
                                    TextInput::make('ticket_amount')
                                        ->label('Cantidad de tickets')
                                        ->rules(['numeric'])
                                        ->maxLength(255),
                                    TextInput::make('price')
                                        ->rules(['numeric'])
                                        ->label('Monto')
                                        ->minValue(1)
                                        ->prefix('$'),
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
                    ->label('Imagen')
                    ->size(50),
                TextColumn::make('title')->label('Datos de la rifa')->searchable()->sortable()->description(function ($record) {
                    return Str::words(strip_tags($record->description), 8, '...');
                }),
                TextColumn::make('date')
                    ->label('Fecha de la rifa')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/y h:i a')
                    ->limit(50),
                TextColumn::make('ticket_price')
                    ->label('Precio del ticket')
                    ->sortable()
                    ->searchable()
                    ->money('MXN', true)
                    ->formatStateUsing(fn($state) => '$' . number_format($state, 2))
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
