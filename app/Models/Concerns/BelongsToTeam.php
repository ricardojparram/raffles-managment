<?php

namespace App\Models\Concerns;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TenantService;

trait BelongsToTeam
{
    protected static function bootBelongsToTeam()
    {
        static::addGlobalScope('team', function (Builder $builder) {
            $tenant = app(TenantService::class)->getTenant();
            if ($tenant) {
                $builder->where($builder->getModel()->getTable() . '.team_id', $tenant->id);
            }
        });

        static::creating(function ($model) {
            $tenant = app(TenantService::class)->getTenant();
            if ($tenant && empty($model->team_id)) {
                $model->team_id = $tenant->id;
            }
        });
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
