<?php

namespace App\Observers;

use App\Models\Raffle;
use Filament\Facades\Filament;

class RaffleObserver
{
    public function created(Raffle $raffle): void
    {
        $team = $raffle->team;

        if ($team && $team->subscribed() && $team->canConsume('raffles_created')) {
            $team->consume('raffles_created');
        }
    }

    public function deleted(Raffle $raffle): void
    {
        $team = $raffle->team;

        if ($team && $team->subscribed()) {
            $team->release('raffles_created');
        }
    }
}
