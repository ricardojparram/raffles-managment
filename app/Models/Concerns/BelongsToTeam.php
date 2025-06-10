<?php

namespace App\Models\Concerns;

use App\Models\Team;

trait BelongsToTeam
{
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
