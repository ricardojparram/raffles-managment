<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class PublicRaffleController extends Controller
{
    /**
     * Show the page an organizer shares so people can buy tickets for a raffle.
     */
    public function __invoke(Team $team, Raffle $raffle): View
    {
        $status = $raffle->loadCount('tickets')->salesStatus();

        abort_unless($status->isPubliclyVisible(), 404);

        $raffle->load(['offers', 'raffle_prizes']);

        return view('raffles.show', [
            'team' => $team,
            'raffle' => $raffle,
            'status' => $status,
            'paymentMethods' => $team->paymentMethods()->orderBy('title')->get(),
            'description' => Str::of($raffle->description)->sanitizeHtml()->toString(),
            'summary' => Str::of($raffle->description)->stripTags()->squish()->limit(155)->toString(),
        ]);
    }
}
