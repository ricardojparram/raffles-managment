<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Enums\Status;
use App\Models\Raffle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Split;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\RaffleResource\Pages;
use Guava\FilamentIconSelectColumn\Tables\Columns\IconSelectColumn;

class RaffleResource extends Resource
{
    protected static ?string $model = Raffle::class;

    protected static ?string $slug = 'rifas';
    protected static ?string $label = "rifa";
    protected static ?string $pluralLabel = "rifas";

    protected static ?string $navigationLabel = 'Rifas';
    protected static ?string $navigationIcon = 'heroicon-o-gift';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
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
                                ->itemLabel(fn(array $state): ?string => isset($state['title'], $state['date']) ? $state['title'] . ' el ' .  date('d/m/Y', strtotime($state['date'])) : null)
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
                    ->closeOnSelection()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()->modalWidth(\Filament\Support\Enums\MaxWidth::ScreenExtraLarge)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRaffles::route('/'),
            'create' => Pages\CreateRaffle::route('/create'),
            'edit' => Pages\EditRaffle::route('/{record}/edit'),
        ];
    }
}
