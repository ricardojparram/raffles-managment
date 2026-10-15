<?php

namespace App\Providers;

use App\Services\TenantService;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use BladeUI\Icons\Factory;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TenantService::class, function ($app) {
            return new TenantService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->locales([
                'es', 'en',
            ]);
        });

        FilamentAsset::register([
            Css::make('custom-styles', public_path('css/custom.css')),
        ]);

        $this->callAfterResolving(Factory::class, function (Factory $factory): void {
            $factory->add('pay', [
                'path' => resource_path('svg'),
                'prefix' => 'pay',
            ]);
        });
    }
}
