<?php

namespace App\Models;

use Spatie\Multitenancy\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Team extends Tenant
{
    use HasSlug;

    protected $fillable = ['name', 'slug'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function raffles()
    {
        return $this->hasMany(Raffle::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
            ->slugsShouldBeNoLongerThan(50);
    }

    public function getTenantKey()
    {
        return $this->getKey();
    }
    public function getDatabaseName(): string
    {
        // Retorna el nombre de tu base de datos central
        return env('DB_DATABASE', 'laravel');
    }

    // public function getDatabaseName(): string
    // {
    //     return $this->database_name ?? $this->generateDatabaseName();
    // }

    // protected function generateDatabaseName(): string
    // {
    //     $prefix = config('multitenancy.database.prefix', 'tenant_');
    //     $this->database_name = $prefix . $this->slug;
    //     $this->save();

    //     return $this->database_name;
    // }
}
