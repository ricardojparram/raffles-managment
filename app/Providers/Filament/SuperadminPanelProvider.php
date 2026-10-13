<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SuperadminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('superadmin')
            ->path('superadmin')
            ->login()
            ->colors([
                'primary' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Superadmin/Resources'), for: 'App\Filament\Superadmin\Resources')
            ->discoverPages(in: app_path('Filament/Superadmin/Pages'), for: 'App\Filament\Superadmin\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Superadmin/Widgets'), for: 'App\Filament\Superadmin\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                \DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin::make()
                    ->enabled(app()->environment('local'))
                    ->users([
                        'Superadmin' => 'admin@admin.com',
                    ]),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn (): string => \Illuminate\Support\Facades\Blade::render('
                    <style>
                        .fi-topbar {
                            background-color: #f9fafb !important; /* tailwind gray-50 */
                            border-bottom: none !important;
                            box-shadow: none !important;
                        }
                        .dark .fi-topbar {
                            background-color: #09090b !important; /* tailwind zinc-950 */
                        }
                        .fi-topbar > nav {
                            background-color: transparent !important;
                        }
                        /* Premium Sidebar Animations */
                        .fi-sidebar {
                            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                            will-change: width;
                        }
                        .fi-sidebar-item-label {
                            transition: opacity 0.3s ease, transform 0.3s ease !important;
                        }
                        /* Animate the collapse button (chevron) moving / translating */
                        .fi-sidebar-collapse-btn {
                            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        }
                        .fi-sidebar-collapse-btn:hover {
                            transform: translateX(4px);
                        }
                        /* Fix filament-phone-input to look perfectly native */
                        .iti {
                            width: 100% !important;
                            display: block !important;
                        }
                        .iti__flag-container {
                            background-color: rgb(243 244 246) !important;
                            border-right: 1px solid rgb(229 231 235) !important;
                            border-top-left-radius: 0.5rem !important;
                            border-bottom-left-radius: 0.5rem !important;
                        }
                        .dark .iti__flag-container {
                            background-color: rgba(255, 255, 255, 0.05) !important;
                            border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
                        }
                        .iti--allow-dropdown .iti__flag-container:hover {
                            background-color: rgb(229 231 235) !important;
                        }
                        .dark .iti--allow-dropdown .iti__flag-container:hover {
                            background-color: rgba(255, 255, 255, 0.1) !important;
                        }
                        .iti__selected-flag {
                            padding: 0 0.75rem !important;
                        }
                    </style>
                ')
            );
    }
}
