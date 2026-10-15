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
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
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
            $current = $record?->type ?? $get('type');
            if ($current instanceof PaymentMethodType) {
                return in_array($current, $targets, true);
            }

            $enum = is_string($current) ? PaymentMethodType::tryFrom($current) : null;

            return in_array($enum, $targets, true);
        };

        return $schema
            ->components([
                Section::make(__('Datos e Instrucciones de Pago'))
                    ->description(__('Configurá los datos que verá el comprador al momento de realizar el pago por este método.'))
                    ->icon('heroicon-o-clipboard-document-list')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_active')
                            ->label(__('Activo para recibir pagos'))
                            ->helperText(__('Si está desactivado, no se mostrará como opción en la página de las rifas ni en el checkout.'))
                            ->default(true)
                            ->columnSpanFull(),

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
                            ->columnSpanFull()
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
                            ->columnSpanFull()
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
                                PaymentMethodType::PagoMovil => 'pay-pago-movil',
                                PaymentMethodType::Transferencia => 'pay-transferencia',
                                PaymentMethodType::Binance => 'pay-binance',
                                PaymentMethodType::Zelle => 'pay-zelle',
                                default => 'heroicon-o-credit-card',
                            })
                            ->iconColor(fn (PaymentMethod $record) => match ($record->type) {
                                PaymentMethodType::Zelle => Color::hex('#9333ea'),
                                PaymentMethodType::Binance => Color::hex('#F3BA2F'),
                                PaymentMethodType::PagoMovil => 'danger',
                                PaymentMethodType::Transferencia => 'info',
                                default => 'gray',
                            }),
                        ToggleColumn::make('is_active')
                            ->label(__('Activo'))
                            ->grow(false),
                    ]),
                    TextColumn::make('description_html')
                        ->label(__('Datos de la cuenta'))
                        ->html()
                        ->state(function (PaymentMethod $record): string {
                            if (empty($record->description) || ! collect($record->description)->filter(fn ($v) => filled($v))->count()) {
                                return '<div class="flex items-center gap-2 rounded-xl border border-dashed border-amber-500/30 bg-amber-500/10 px-3.5 py-2.5 text-xs font-semibold text-amber-400">
                                    <svg class="size-4 shrink-0 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <span>'.e(__('Pendiente por configurar datos de cobro')).'</span>
                                </div>';
                            }

                            $html = '<div class="grid grid-cols-1 sm:grid-cols-2 gap-2 my-1">';

                            foreach ($record->description as $label => $value) {
                                if (! filled($value)) {
                                    continue;
                                }

                                $isLong = in_array($label, ['Número de Cuenta', 'Titular', 'Correo', 'Banco'], true) || strlen((string) $value) > 24;
                                $colSpan = $isLong ? 'sm:col-span-2' : 'col-span-1';

                                $labelEscaped = e($label);
                                $valueEscaped = e((string) $value);

                                $html .= '<div class="flex flex-col justify-center rounded-xl bg-neutral-100/80 dark:bg-white/[0.04] border border-neutral-200/80 dark:border-white/[0.08] px-3 py-2 shadow-2xs '.$colSpan.'">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-neutral-400 dark:text-neutral-400 leading-tight">'.$labelEscaped.'</span>
                                    <span class="text-xs font-semibold text-neutral-900 dark:text-neutral-100 font-mono tracking-tight select-all truncate mt-0.5 leading-snug" title="'.$valueEscaped.'">'.$valueEscaped.'</span>
                                </div>';
                            }

                            $html .= '</div>';

                            return $html;
                        }),
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
                EditAction::make()
                    ->label(__('Editar datos'))
                    ->icon('heroicon-m-pencil-square')
                    ->button()
                    ->size('sm'),
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
