<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Raffle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\RaffleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RaffleResource\RelationManagers;

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
        $decimalStateFormating = fn($state) => ($state == '') ? '' : str_replace('.', ',', $state / 100);
        $moneyMask = RawJs::make("\$money(\$input, ',', '.', 2)");
        return $form
            ->schema([
                Split::make([
                    Grid::make(1)->schema([
                        TextInput::make('title')
                            ->label('Titulo')
                            ->rules(['required', 'string', 'max:255'])
                            ->maxLength(255),
                        DateTimePicker::make('date')
                            ->rules(['required', 'date'])
                            ->seconds(false)
                            ->native(false)
                            ->label('Fecha de la rifa')
                            ->placeholder('Selecciona la fecha de la rifa'),
                        TextInput::make('ticket_price')
                            ->rules(['required', 'numeric'])
                            ->label('Precio del ticket')
                            ->numeric()
                            ->minValue(1)
                            ->formatStateUsing($decimalStateFormating)
                            ->mask($moneyMask)
                            ->prefix('$'),
                        FileUpload::make('img')
                            ->required('La imagen es requerido')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor(),
                    ])->grow(false),
                    Grid::make(1)->schema([
                        RichEditor::make('description')
                            ->rules(['required'])
                            ->label('Descripción de la rifa')
                            ->placeholder('Escribe una descripción de la rifa'),
                    ])
                ])->from('md')->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                ImageColumn::make('img')
                    ->label('Imagen')
                    ->size(50),
                TextColumn::make('title')
                    ->label('Titulo')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('date')
                    ->label('Fecha de la rifa')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/Y H:i')
                    ->limit(50),
                TextColumn::make('ticket_price')
                    ->label('Precio del ticket')
                    ->sortable()
                    ->searchable()
                    ->money('MXN', true)
                    ->formatStateUsing(fn($state) => '$' . number_format($state, 2))
                    ->limit(50),
                TextColumn::make('description')
                    ->label('Descripción de la rifa')
                    ->sortable()
                    ->searchable()
                    ->limit(50)
                    ->html()
                    ->formatStateUsing(fn($state) => strip_tags($state)),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
