<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicTenantController extends Controller
{
    public function index(string $team_slug)
    {
        $team = \App\Models\Team::where('slug', $team_slug)->firstOrFail();

        // Obtener rifas activas (puedes agregar lógica de fecha/status después)
        $raffles = $team->raffles()->get();

        return view('public.tenant.index', compact('team', 'raffles'));
    }
}
