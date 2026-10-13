<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Raffle;
use App\Models\Team;
use Illuminate\Contracts\View\View;

class PublicTeamController extends Controller
{
    /**
     * Number of past raffles kept on the organizer's public page.
     */
    private const PAST_RAFFLES_SHOWN = 12;

    /**
     * Show the raffles an organizer shares with the public.
     */
    public function __invoke(Team $team): View
    {
        [$onSale, $past] = $team->raffles()
            ->where('status', '!=', Status::Pending->value)
            ->withCount('tickets')
            ->orderBy('date')
            ->get()
            ->partition(fn (Raffle $raffle): bool => $raffle->salesStatus()->isOpen());

        return view('raffles.index', [
            'team' => $team,
            'onSale' => $onSale->values(),
            'past' => $past->sortByDesc('date')->take(self::PAST_RAFFLES_SHOWN)->values(),
        ]);
    }
}
