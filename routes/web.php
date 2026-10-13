<?php

use App\Http\Controllers\PublicRaffleController;
use App\Http\Controllers\PublicTeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('r')->name('raffles.')->scopeBindings()->group(function () {
    Route::get('{team:slug}', PublicTeamController::class)->name('index');
    Route::get('{team:slug}/{raffle:slug}', PublicRaffleController::class)->name('show');
});
