<?php

namespace App\Filament\Resources;

use App\Enums\PaymentMethodType;
use App\Filament\Resources\PaymentMethodResource\Pages\CreatePaymentMethod;
use App\Filament\Resources\PaymentMethodResource\Pages\EditPaymentMethod;
use App\Filament\Resources\PaymentMethodResource\Pages\ListPaymentMethods;
use App\Models\PaymentMethod;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;

    protected static ?string $slug = 'payment-methods';

    public static function getLabel(): ?string
    {
        return __('Payment Method');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Payment Methods');
    }

    public static function getNavigationLabel(): string
    {
        return __('Payment Methods');
    }

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Schema $schema): Schema
    {
        $matchesType = function (Get $get, PaymentMethodType ...$targets): bool {
            $current = $get('type');
            if ($current instanceof PaymentMethodType) {
                return in_array($current, $targets, true);
            }

            $enum = is_string($current) ? PaymentMethodType::tryFrom($current) : null;

            return in_array($enum, $targets, true);
        };

        return $schema
            ->components([
                Section::make(__('Configuración del Método'))
                    ->description(__('Configurá el canal de pago, si está activo y su moneda.'))
                    ->icon('heroicon-o-credit-card')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('type')
                                    ->label(__('Tipo de método'))
                                    ->options(PaymentMethodType::class)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set, mixed $state) {
                                        if (! $state) {
                                            return;
                                        }
                                        $enum = $state instanceof PaymentMethodType ? $state : PaymentMethodType::tryFrom((string) $state);
                                        if ($enum) {
                                            $currentTitle = $get('title');
                                            $titles = array_map(fn ($e) => $e->defaultTitle(), PaymentMethodType::cases());
                                            if (blank($currentTitle) || in_array($currentTitle, $titles, true)) {
                                                $set('title', $enum->defaultTitle());
                                            }
                                            $set('currency', $enum->defaultCurrency());
                                        }
                                    })
                                    ->required(),
                                TextInput::make('title')
                                    ->label(__('Nombre'))
                                    ->placeholder(__('Ej. Pago Móvil BDV, Zelle'))
                                    ->rules(['required', 'string', 'max:255'])
                                    ->markAsRequired(),
                                Select::make('currency')
                                    ->label(__('Moneda'))
                                    ->options([
                                        'VED' => '🇻🇪 Bolívar (VED) - Bs.',
                                        'USD' => '🇺🇸 Dólar (USD) - $',
                                    ])
                                    ->required()
                                    ->default('VED'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label(__('Activo para recibir pagos'))
                                    ->helperText(__('Si está desactivado, no se mostrará como opción en la página de las rifas ni en el checkout.'))
                                    ->default(true),
                                FileUpload::make('icon')
                                    ->label(__('Icono / Logo (Opcional)'))
                                    ->image()
                                    ->imageEditor()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                                    ->disk('public')
                                    ->visibility('public')
                                    ->directory('payment-methods')
                                    ->nullable(),
                            ]),
                    ]),

                Section::make(__('Datos e Instrucciones de Pago'))
                    ->description(__('Datos que verá el comprador para realizar el pago (Banco, Teléfono, Cédula, etc.).'))
                    ->icon('heroicon-o-clipboard-document-list')
                    ->schema([
                        Select::make('description.Banco')
                            ->label(__('Banco'))
                            ->options([
                                'Banco de Venezuela (0102)' => 'Banco de Venezuela (0102)',
                                'Banesco (0134)' => 'Banesco (0134)',
                                'Mercantil (0105)' => 'Mercantil (0105)',
                                'BBVA Provincial (0108)' => 'BBVA Provincial (0108)',
                                'Bancamiga (0172)' => 'Bancamiga (0172)',
                                'Banco Nacional de Crédito BNC (0191)' => 'Banco Nacional de Crédito BNC (0191)',
                                'Banco Bicentenario (0175)' => 'Banco Bicentenario (0175)',
                                'Bancaribe (0114)' => 'Bancaribe (0114)',
                                'Banco Exterior (0115)' => 'Banco Exterior (0115)',
                                'Banco del Tesoro (0163)' => 'Banco del Tesoro (0163)',
                            ])
                            ->searchable()
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::PagoMovil, PaymentMethodType::Transferencia))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::PagoMovil, PaymentMethodType::Transferencia)),

                        TextInput::make('description.Teléfono')
                            ->label(__('Teléfono receptor'))
                            ->placeholder('Ej. 0412-1234567')
                            ->tel()
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::PagoMovil))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::PagoMovil)),

                        TextInput::make('description.Cédula')
                            ->label(__('Cédula o RIF'))
                            ->placeholder('Ej. V-12345678')
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::PagoMovil))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::PagoMovil)),

                        TextInput::make('description.Número de Cuenta')
                            ->label(__('Número de Cuenta (20 dígitos)'))
                            ->placeholder('0102-0000-00-0000000000')
                            ->maxLength(24)
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::Transferencia))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::Transferencia)),

                        TextInput::make('description.Cédula / RIF')
                            ->label(__('Cédula / RIF del Titular'))
                            ->placeholder('Ej. J-12345678-0')
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::Transferencia))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::Transferencia)),

                        TextInput::make('description.Titular')
                            ->label(__('Nombre del Titular'))
                            ->placeholder('Ej. Rifas y Eventos C.A. o Nombre Completo')
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::Transferencia, PaymentMethodType::Zelle))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::Transferencia, PaymentMethodType::Zelle)),

                        TextInput::make('description.Pay ID')
                            ->label(__('Binance Pay ID'))
                            ->placeholder('Ej. 284551903')
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::Binance))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::Binance)),

                        TextInput::make('description.Usuario')
                            ->label(__('Usuario Binance'))
                            ->placeholder('Ej. rifas_elchamo')
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::Binance))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::Binance)),

                        TextInput::make('description.Correo')
                            ->label(__('Correo electrónico Zelle'))
                            ->email()
                            ->placeholder('pagos@ejemplo.com')
                            ->required(fn (Get $get) => $matchesType($get, PaymentMethodType::Zelle))
                            ->visible(fn (Get $get) => $matchesType($get, PaymentMethodType::Zelle)),

                        KeyValue::make('custom_description')
                            ->label(__('Detalles personalizados'))
                            ->keyLabel(__('Campo'))
                            ->valueLabel(__('Valor'))
                            ->addActionLabel(__('Agregar fila'))
                            ->reorderable()
                            ->columnSpanFull()
                            ->visible(fn (Get $get) => ! $matchesType(
                                $get,
                                PaymentMethodType::PagoMovil,
                                PaymentMethodType::Transferencia,
                                PaymentMethodType::Binance,
                                PaymentMethodType::Zelle,
                            )),
                    ]),

                Section::make(__('Integraciones y Pasarelas de Pago'))
                    ->description(__('Conexiones directas para validación automática de pagos sin comprobantes manuales.'))
                    ->icon('heroicon-o-bolt')
                    ->schema([
                        Placeholder::make('integration_info')
                            ->label('')
                            ->content('⚡ Próximamente: Integración automática con APIs bancarias de Venezuela (Banesco, BDV, Mercantil) y pasarelas como Pabilo para conciliación instantánea.'),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')
                    ->label(__('Icon'))
                    ->disk('public')
                    ->size(40),
                TextColumn::make('title')
                    ->label(__('Método'))
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(function (PaymentMethod $record) {
                        return $record->description ? collect($record->description)->map(fn ($value, $key) => "$key: $value")->join(' • ') : null;
                    }),
                TextColumn::make('type')
                    ->label(__('Tipo'))
                    ->badge(),
                TextColumn::make('currency')
                    ->label(__('Moneda'))
                    ->badge()
                    ->color(fn (string $state): string => $state === 'VED' ? 'danger' : 'success')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'VED' => '🇻🇪 VED (Bs.)',
                        'USD' => '🇺🇸 USD ($)',
                        default => $state,
                    }),
                ToggleColumn::make('is_active')
                    ->label(__('Activo')),
                TextColumn::make('integration')
                    ->label(__('Integración'))
                    ->state(function (PaymentMethod $record): string {
                        return match ($record->type) {
                            PaymentMethodType::PagoMovil, PaymentMethodType::Transferencia => 'Manual (API bancaria pronto)',
                            PaymentMethodType::Binance => 'Manual (Binance Pay pronto)',
                            default => 'Manual',
                        };
                    })
                    ->badge()
                    ->color('gray'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentMethods::route('/'),
            'create' => CreatePaymentMethod::route('/create'),
            'edit' => EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
