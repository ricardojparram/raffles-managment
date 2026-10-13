<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;

class UserPolicy
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

    public function view(User $user, User $model): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->isAdminOf($tenant)) {
            return false;
        }

        return $model->teams()->whereKey($tenant->id)->exists();
    }

    public function create(User $user): bool
    {
        $tenant = $this->currentTenant();
        return $tenant !== null && $user->isAdminOf($tenant);
    }

    public function update(User $user, User $model): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->isAdminOf($tenant)) {
            return false;
        }

        // Target user must belong to current team
        if (! $model->teams()->whereKey($tenant->id)->exists()) {
            return false;
        }

        // An admin cannot update the owner unless it's the owner themselves
        if ($model->isOwnerOf($tenant) && $user->id !== $model->id) {
            return false;
        }

        return true;
    }

    public function delete(User $user, User $model): bool
    {
        $tenant = $this->currentTenant();
        if (! $tenant || ! $user->isAdminOf($tenant)) {
            return false;
        }

        // Cannot delete yourself
        if ($user->id === $model->id) {
            return false;
        }

        // Target user must belong to current team
        if (! $model->teams()->whereKey($tenant->id)->exists()) {
            return false;
        }

        // Cannot delete the owner
        if ($model->isOwnerOf($tenant)) {
            return false;
        }

        return true;
    }
}
