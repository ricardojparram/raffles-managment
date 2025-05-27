<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasLabel, HasColor, HasIcon
{

    case Confirmed = 'confirmed';
    case Rejected = 'rejected';
    case Pending = 'pending';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pending => 'Por confirmar',
            self::Confirmed => 'Confirmado',
            self::Rejected => 'Rechazado',
        };
    }
    public function getColor(): ?string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Confirmed => 'success',
            self::Rejected => 'danger',
        };
    }
    public function getIcon(): ?string
    {
        return match ($this) {
            self::Pending => 'heroicon-o-ellipsis-horizontal-circle',
            self::Confirmed => 'heroicon-o-check-circle',
            self::Rejected => 'heroicon-o-x-circle',
        };
    }
}
