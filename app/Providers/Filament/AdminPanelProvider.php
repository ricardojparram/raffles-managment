<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Tenancy\EditTeamProfile;
use App\Filament\Pages\Tenancy\RegisterTeam;
use App\Models\Team;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\Column;
use Filament\Tables\Table;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

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
            ->navigationItems([
                NavigationItem::make('public-page')
                    ->label(fn (): string => __('My public page'))
                    ->icon('heroicon-o-globe-alt')
                    ->url(fn (): string => route('raffles.index', Filament::getTenant()), shouldOpenInNewTab: true)
                    ->sort(100),
            ])
            ->tenant(Team::class, 'slug')
            ->tenantRegistration(RegisterTeam::class)
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
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
                        /* Floating cards layout for Payment Methods (no table container) */
                        .fi-ta-floating-cards .fi-ta-ctn {
                            background-color: transparent !important;
                            border: none !important;
                            box-shadow: none !important;
                            ring: none !important;
                            --tw-ring-shadow: none !important;
                            --tw-shadow: none !important;
                            border-radius: 0 !important;
                        }
                        .fi-ta-floating-cards .fi-ta-header-ctn,
                        .fi-ta-floating-cards .fi-ta-header,
                        .fi-ta-floating-cards thead {
                            display: none !important;
                        }
                        .fi-ta-floating-cards .fi-ta-group-header {
                            background-color: transparent !important;
                            border: none !important;
                            box-shadow: none !important;
                            padding: 1.25rem 0.25rem 0.5rem !important;
                        }
                        .fi-ta-floating-cards .fi-ta-group-heading {
                            font-size: 1.125rem !important;
                            font-weight: 700 !important;
                            color: inherit !important;
                        }
                        .fi-ta-floating-cards .fi-ta-content-grid {
                            gap: 1rem !important;
                        }
                    </style>
                ')
            )
            ->registration()
            ->tenantProfile(EditTeamProfile::class);
    }
}
