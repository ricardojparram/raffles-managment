<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicTenantController;
use App\Livewire\Public\RaffleShow;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('{team_slug}')
    ->where(['team_slug' => '^(?!admin|superadmin|livewire|api|_debugbar)[^/]+$'])
    ->group(function () {
        Route::get('/', [PublicTenantController::class, 'index'])->name('public.tenant.index');
        Route::get('/{raffle_slug}', RaffleShow::class)->name('public.raffle.show');
    });

