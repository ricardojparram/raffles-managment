<?php

namespace App\Observers;

use App\Models\TeamUser;
use App\Models\Team;

class TeamMemberObserver
{
    public function created(TeamUser $teamUser): void
    {
        $team = Team::find($teamUser->team_id);
        if ($team && $team->subscribed() && $team->canConsume('team_members')) {
            $team->consume('team_members');
        }
    }

    public function deleted(TeamUser $teamUser): void
    {
        $team = Team::find($teamUser->team_id);
        if ($team && $team->subscribed()) {
            $team->release('team_members');
        }
    }
}
