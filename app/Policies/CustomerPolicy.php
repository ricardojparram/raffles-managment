<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;

class CustomerPolicy
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

    public function view(User $user, Customer $customer): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->canAccessTenant($tenant)) {
            return false;
        }

        return (int) $customer->team_id === (int) $tenant->id;
    }

    public function create(User $user): bool
    {
        $tenant = $this->currentTenant();
        return $tenant !== null && $user->canSellFor($tenant);
    }

    public function update(User $user, Customer $customer): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->canSellFor($tenant)) {
            return false;
        }

        return (int) $customer->team_id === (int) $tenant->id;
    }

    public function delete(User $user, Customer $customer): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->isAdminOf($tenant)) {
            return false;
        }

        return (int) $customer->team_id === (int) $tenant->id;
    }
}
