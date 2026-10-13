<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;

class PaymentPolicy
{
    private function currentTenant(): ?Team
    {
        return Filament::getTenant() ?? auth()->user()?->currentTeam();
    }

    public function viewAny(User $user): bool
    {
        $tenant = $this->currentTenant();
        return $tenant !== null && $user->canAccessTenant($tenant);
    }

    public function view(User $user, Payment $payment): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->canAccessTenant($tenant)) {
            return false;
        }

        return (int) $payment->team_id === (int) $tenant->id;
    }

    public function create(User $user): bool
    {
        $tenant = $this->currentTenant();
        return $tenant !== null && $user->canSellFor($tenant);
    }

    public function update(User $user, Payment $payment): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->canManagePaymentsOf($tenant)) {
            return false;
        }

        return (int) $payment->team_id === (int) $tenant->id;
    }

    public function delete(User $user, Payment $payment): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->isOwnerOf($tenant)) {
            return false;
        }

        return (int) $payment->team_id === (int) $tenant->id;
    }
}
