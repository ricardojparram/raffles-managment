<?php

namespace App\Policies;

use App\Models\Raffle;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;

class RafflePolicy
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

    public function view(User $user, Raffle $raffle): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->canAccessTenant($tenant)) {
            return false;
        }

        return (int) $raffle->team_id === (int) $tenant->id;
    }

    public function create(User $user): bool
    {
        $tenant = $this->currentTenant();
        return $tenant !== null && $user->canManageRafflesOf($tenant);
    }

    public function update(User $user, Raffle $raffle): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->canManageRafflesOf($tenant)) {
            return false;
        }

        return (int) $raffle->team_id === (int) $tenant->id;
    }

    public function delete(User $user, Raffle $raffle): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->isOwnerOf($tenant)) {
            return false;
        }

        return (int) $raffle->team_id === (int) $tenant->id;
    }
}
