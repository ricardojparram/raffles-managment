<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

// use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasTenants
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    // use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams()->whereKey($tenant)->exists();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
    public function currentTeam()
    {
        return session('current_team_id')
            ? $this->teams()->find(session('current_team_id'))
            : $this->teams()->first();
    }

    public function roleIn(?Team $team = null): ?\App\Enums\TeamRole
    {
        $team = $team ?? \Filament\Facades\Filament::getTenant() ?? $this->currentTeam();
        if (! $team) {
            return null;
        }

        $pivot = $this->teams()->where('teams.id', $team->id)->first()?->pivot;
        if (! $pivot || ! $pivot->role) {
            return null;
        }

        return \App\Enums\TeamRole::fromString($pivot->role);
    }

    public function isOwnerOf(?Team $team = null): bool
    {
        return $this->roleIn($team)?->isOwner() ?? false;
    }

    public function isAdminOf(?Team $team = null): bool
    {
        return $this->roleIn($team)?->isAdmin() ?? false;
    }

    public function isSellerOf(?Team $team = null): bool
    {
        return $this->roleIn($team) === \App\Enums\TeamRole::SELLER;
    }

    public function canManageRafflesOf(?Team $team = null): bool
    {
        return $this->roleIn($team)?->canManageRaffles() ?? false;
    }

    public function canManagePaymentsOf(?Team $team = null): bool
    {
        return $this->roleIn($team)?->canManagePayments() ?? false;
    }

    public function canSellFor(?Team $team = null): bool
    {
        return $this->roleIn($team)?->canSell() ?? false;
    }
}
