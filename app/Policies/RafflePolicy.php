<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Raffle;
use Illuminate\Auth\Access\HandlesAuthorization;

class RafflePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Raffle');
    }

    public function view(AuthUser $authUser, Raffle $raffle): bool
    {
        return $authUser->can('View:Raffle');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Raffle');
    }

    public function update(AuthUser $authUser, Raffle $raffle): bool
    {
        return $authUser->can('Update:Raffle');
    }

    public function delete(AuthUser $authUser, Raffle $raffle): bool
    {
        return $authUser->can('Delete:Raffle');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Raffle');
    }

    public function restore(AuthUser $authUser, Raffle $raffle): bool
    {
        return $authUser->can('Restore:Raffle');
    }

    public function forceDelete(AuthUser $authUser, Raffle $raffle): bool
    {
        return $authUser->can('ForceDelete:Raffle');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Raffle');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Raffle');
    }

    public function replicate(AuthUser $authUser, Raffle $raffle): bool
    {
        return $authUser->can('Replicate:Raffle');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Raffle');
    }

}