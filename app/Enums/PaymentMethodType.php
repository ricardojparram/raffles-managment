<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethodType: string implements HasColor, HasIcon, HasLabel
{
    case PagoMovil = 'pago_movil';
    case Transferencia = 'transferencia';
    case Binance = 'binance';
    case Zelle = 'zelle';
    case Custom = 'custom';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PagoMovil => 'Pago Móvil (Venezuela)',
            self::Transferencia => 'Transferencia Bancaria (Venezuela)',
            self::Binance => 'Binance Pay (Cripto)',
            self::Zelle => 'Zelle (EE.UU.)',
            self::Custom => 'Otro / Personalizado',
        };
    }

    public function defaultTitle(): string
    {
        return match ($this) {
            self::PagoMovil => 'Pago Móvil',
            self::Transferencia => 'Transferencia Bancaria',
            self::Binance => 'Binance Pay',
            self::Zelle => 'Zelle',
            self::Custom => 'Otro Método',
        };
    }

    public function defaultCurrency(): string
    {
        return match ($this) {
            self::PagoMovil, self::Transferencia => 'VED',
            self::Binance, self::Zelle, self::Custom => 'USD',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::PagoMovil => 'danger',
            self::Transferencia => 'info',
            self::Binance => 'warning',
            self::Zelle => 'primary',
            self::Custom => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PagoMovil => 'heroicon-o-device-phone-mobile',
            self::Transferencia => 'heroicon-o-building-library',
            self::Binance => 'heroicon-o-currency-dollar',
            self::Zelle => 'heroicon-o-banknotes',
            self::Custom => 'heroicon-o-credit-card',
        };
    }

    public function supportsAutomaticIntegration(): bool
    {
        return match ($this) {
            self::PagoMovil, self::Transferencia => true,
            default => false,
        };
    }
}
