<?php

namespace App\Providers\Filament;

use Filament\Pages\Dashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use App\Filament\Pages\Auth\Register;
use App\Models\Team;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\Tables\Table;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\Column;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        Table::configureUsing(function (Table $table): void {
            $table
                ->defaultPaginationPageOption(10)
                ->paginationPageOptions([10, 25, 50]);
        });
        Column::configureUsing(function (Column $section): void {
            $section
                ->disabledClick();
        });
    }
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->colors([
                'primary' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->tenant(Team::class, 'slug')
            // tenantRegistration removed — handled in custom Register wizard
            ->tenantMiddleware([
                \App\Http\Middleware\SyncSpatiePermissionsWithFilamentTenant::class,
            ], isPersistent: true)
            ->sidebarCollapsibleOnDesktop()
            ->plugins([
                \DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin::make()
                    ->enabled(app()->environment('local'))
                    ->users([
                        'Admin' => 'admin@admin.com',
                    ])
            ])
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
            )
            ->registration(Register::class);
        // ->tenantProfile(\App\Filament\Pages\Tenancy\EditTeamProfile::class)
    }
}
