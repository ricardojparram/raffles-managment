<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\TenantService::class, function ($app) {
            return new \App\Services\TenantService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->locales([
                'es', 'en'
            ]);
        });

        FilamentAsset::register([
            Css::make('custom-styles', public_path('css/custom.css')),
        ]);

        \App\Models\Role::observe(\App\Observers\RoleObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Raffle::observe(\App\Observers\RaffleObserver::class);
        \App\Models\Customer::observe(\App\Observers\CustomerObserver::class);
        \App\Models\TeamUser::observe(\App\Observers\TeamMemberObserver::class);
    }
}
