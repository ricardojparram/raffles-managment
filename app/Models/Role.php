<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    /**
     * Get the team that the role belongs to.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, config('permission.column_names.team_foreign_key', 'team_id'));
    }
}
