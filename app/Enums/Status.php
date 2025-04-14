<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel, HasColor, HasIcon
{
    case Active = 'active';
    case Canceled = 'canceled';
    case Finished = 'finished';
    case Pending = 'pending';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Active => 'Activo',
            self::Canceled => 'Cancelado',
            self::Finished => 'Finalizado',
            self::Pending => 'Por confirmar',
        };
    }
    public function getColor(): ?string
    {
        return match ($this) {
            self::Active => 'success',
            self::Canceled => 'danger',
            self::Finished => 'gray',
            self::Pending => 'warning',
        };
    }
    public function getIcon(): ?string
    {
        return match ($this) {
            self::Active => 'heroicon-o-check-circle',
            self::Canceled => 'heroicon-o-x-circle',
            self::Finished => 'heroicon-o-check-circle',
            self::Pending => 'heroicon-o-ellipsis-horizontal-circle',
        };
    }
}
