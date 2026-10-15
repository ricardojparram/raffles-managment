<?php

namespace App\Filament\Resources;

use App\Enums\PaymentMethodType;
use App\Filament\Resources\PaymentMethodResource\Pages\EditPaymentMethod;
use App\Filament\Resources\PaymentMethodResource\Pages\ListPaymentMethods;
use App\Models\PaymentMethod;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        $matchesType = function (Get $get, ?PaymentMethod $record, PaymentMethodType ...$targets): bool {
            $current = $get('type') ?? $record?->type;
            if ($current instanceof PaymentMethodType) {
                return in_array($current, $targets, true);
            }

            $enum = is_string($current) ? PaymentMethodType::tryFrom($current) : null;

            return in_array($enum, $targets, true);
        };

        return $schema
            ->components([
                Section::make(__('Configuración del Método'))
                    ->description(__('Canal de pago preconfigurado por la plataforma. Activá o desactivá su disponibilidad y completá los datos de cobro.'))
                    ->icon('heroicon-o-credit-card')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('type')
                                    ->label(__('Tipo de método'))
                                    ->options(PaymentMethodType::class)
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->helperText(__('Definido por la plataforma.')),
                                TextInput::make('title')
                                    ->label(__('Nombre'))
                                    ->disabled()
                                    ->dehydrated(false),
                                Select::make('currency')
                                    ->label(__('Moneda'))
                                    ->options([
                                        'VED' => '🇻🇪 Bolívar (VED) - Bs.',
                                        'USD' => '🇺🇸 Dólar (USD) - $',
                                    ])
                                    ->disabled()
                                    ->dehydrated(false),
                            ]),

                        Toggle::make('is_active')
                            ->label(__('Activo para recibir pagos'))
                            ->helperText(__('Si está desactivado, no se mostrará como opción en la página de las rifas ni en el checkout.'))
                            ->default(true),
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
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::PagoMovil, PaymentMethodType::Transferencia))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::PagoMovil, PaymentMethodType::Transferencia)),

                        TextInput::make('description.Teléfono')
                            ->label(__('Teléfono receptor'))
                            ->placeholder('0412-1234567')
                            ->mask('9999-9999999')
                            ->tel()
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::PagoMovil))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::PagoMovil)),

                        TextInput::make('description.Cédula')
                            ->label(__('Cédula o RIF'))
                            ->placeholder('Ej. V-12345678')
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::PagoMovil))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::PagoMovil)),

                        TextInput::make('description.Número de Cuenta')
                            ->label(__('Número de Cuenta (20 dígitos)'))
                            ->placeholder('0102-0000-00-0000000000')
                            ->mask('9999-9999-99-9999999999')
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Transferencia))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Transferencia)),

                        TextInput::make('description.Cédula / RIF')
                            ->label(__('Cédula / RIF del Titular'))
                            ->placeholder('Ej. J-12345678-0')
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Transferencia))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Transferencia)),

                        TextInput::make('description.Titular')
                            ->label(__('Nombre del Titular'))
                            ->placeholder('Ej. Rifas y Eventos C.A. o Nombre Completo')
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Transferencia, PaymentMethodType::Zelle))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Transferencia, PaymentMethodType::Zelle)),

                        TextInput::make('description.Pay ID')
                            ->label(__('Binance Pay ID'))
                            ->placeholder('Ej. 284551903')
                            ->numeric()
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Binance))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Binance)),

                        TextInput::make('description.Usuario')
                            ->label(__('Usuario Binance'))
                            ->placeholder('Ej. rifas_elchamo')
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Binance))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Binance)),

                        TextInput::make('description.Correo')
                            ->label(__('Correo electrónico Zelle'))
                            ->email()
                            ->placeholder('pagos@ejemplo.com')
                            ->required(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Zelle))
                            ->visible(fn (Get $get, ?PaymentMethod $record) => $matchesType($get, $record, PaymentMethodType::Zelle)),

                        KeyValue::make('custom_description')
                            ->label(__('Detalles personalizados'))
                            ->keyLabel(__('Campo'))
                            ->valueLabel(__('Valor'))
                            ->addActionLabel(__('Agregar fila'))
                            ->reorderable()
                            ->columnSpanFull()
                            ->visible(fn (Get $get, ?PaymentMethod $record) => ! $matchesType(
                                $get,
                                $record,
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
            ->defaultGroup('currency')
            ->groups([
                Group::make('currency')
                    ->label(__('Moneda'))
                    ->getTitleFromRecordUsing(fn (PaymentMethod $record): string => match ($record->currency) {
                        'VED' => '🇻🇪 Cuentas en Bolívares (VED)',
                        'USD' => '🇺🇸 Cuentas en Divisas / Cripto (USD)',
                        default => $record->currency,
                    })
                    ->titlePrefixedWithLabel(false)
                    ->collapsible(false),
            ])
            ->groupingSettingsHidden()
            ->paginated(false)
            ->extraAttributes([
                'class' => 'fi-ta-floating-cards',
            ])
            ->contentGrid([
                'default' => 1,
                'md' => 2,
            ])
            ->columns([
                Stack::make([
                    Split::make([
                        TextColumn::make('title')
                            ->label(__('Método'))
                            ->weight('bold')
                            ->size('lg')
                            ->icon(fn (PaymentMethod $record): string => match ($record->type) {
                                PaymentMethodType::PagoMovil => 'heroicon-o-device-phone-mobile',
                                PaymentMethodType::Transferencia => 'heroicon-o-building-library',
                                PaymentMethodType::Binance => 'heroicon-o-currency-dollar',
                                PaymentMethodType::Zelle => 'heroicon-o-bolt',
                                default => 'heroicon-o-credit-card',
                            }),
                        ToggleColumn::make('is_active')
                            ->label(__('Activo'))
                            ->grow(false),
                    ]),
                    TextColumn::make('type')
                        ->badge()
                        ->color('gray'),
                    TextColumn::make('description_summary')
                        ->label(__('Datos de la cuenta'))
                        ->state(function (PaymentMethod $record): string {
                            if (empty($record->description)) {
                                return '⚠️ '.__('Pendiente por configurar datos de cobro');
                            }

                            return collect($record->description)
                                ->map(fn ($value, $key): string => "{$key}: {$value}")
                                ->join(' • ');
                        })
                        ->color(fn (PaymentMethod $record): string => empty($record->description) ? 'warning' : 'gray')
                        ->size('sm')
                        ->wrap(),
                    Split::make([
                        TextColumn::make('currency')
                            ->badge()
                            ->color(fn (string $state): string => $state === 'VED' ? 'danger' : 'success')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'VED' => '🇻🇪 VED (Bs.)',
                                'USD' => '🇺🇸 USD ($)',
                                default => $state,
                            }),
                        TextColumn::make('integration')
                            ->state(function (PaymentMethod $record): string {
                                return match ($record->type) {
                                    PaymentMethodType::PagoMovil, PaymentMethodType::Transferencia => 'Conciliación manual (API bancaria pronto)',
                                    PaymentMethodType::Binance => 'Conciliación manual (Binance Pay pronto)',
                                    default => 'Conciliación manual',
                                };
                            })
                            ->badge()
                            ->color('gray'),
                    ]),
                ])->space(3),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
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
            'edit' => EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
