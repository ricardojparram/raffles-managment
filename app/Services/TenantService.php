<?php

namespace App\Services;

use App\Models\Team;
use Filament\Facades\Filament;

class TenantService
{
    protected ?Team $tenant = null;

    public function setTenant(?Team $tenant)
    {
        $this->tenant = $tenant;
    }

    public function getTenant(): ?Team
    {
        // Si estamos en un contexto de Filament (panel), usa el tenant de Filament
        if (app()->bound('filament') && Filament::hasTenancy() && Filament::getTenant()) {
            return Filament::getTenant();
        }

        // De lo contrario usa el tenant configurado manualmente (ej. por un Middleware de API)
        return $this->tenant;
    }
}
