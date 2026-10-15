<?php

namespace App\Policies;

use App\Models\PaymentMethod;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;

class PaymentMethodPolicy
{
    private function currentTenant(): ?Team
    {
        return Filament::getTenant() ?? auth()->user()?->currentTeam();
    }

    public function viewAny(User $user): bool
    {
        $tenant = $this->currentTenant();

        return $tenant !== null && $user->isAdminOf($tenant);
    }

    public function view(User $user, PaymentMethod $paymentMethod): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->isAdminOf($tenant)) {
            return false;
        }

        return (int) $paymentMethod->team_id === (int) $tenant->id;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, PaymentMethod $paymentMethod): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->isAdminOf($tenant)) {
            return false;
        }

        return (int) $paymentMethod->team_id === (int) $tenant->id;
    }

    public function delete(User $user, PaymentMethod $paymentMethod): bool
    {
        return false;
    }
}
