<?php

namespace App\Filament\Traits;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;

trait EnforcesFeatureLimit
{
    /**
     * Check if the current tenant can consume more of a given feature.
     *
     * Usage in a Resource:
     *   use EnforcesFeatureLimit;
     *   public static function canCreate(): bool { return static::checkFeatureLimit('raffles_created'); }
     */
    protected static function checkFeatureLimit(string $featureSlug): bool
    {
        $team = Filament::getTenant();

        if (! $team) {
            return false;
        }

        // If the team has no subscription, deny creation
        if (! $team->subscribed()) {
            Notification::make()
                ->title(__('No Active Subscription'))
                ->body(__('You need an active subscription to create resources.'))
                ->warning()
                ->persistent()
                ->send();

            return false;
        }

        // Check if the feature can be consumed
        if (! $team->canConsume($featureSlug)) {
            $info = $team->featureInfo($featureSlug);

            Notification::make()
                ->title(__('Plan Limit Reached'))
                ->body(__('You have reached the :feature limit of your :plan plan. Please upgrade to continue.', [
                    'feature' => $info->name,
                    'plan' => $team->subscription()->getPlan()->getName(),
                ]))
                ->warning()
                ->persistent()
                ->actions([
                    \Filament\Notifications\Actions\Action::make('upgrade')
                        ->label(__('Upgrade Plan'))
                        ->url(route('filament.admin.pages.upgrade-plan', ['tenant' => $team]))
                        ->button(),
                ])
                ->send();

            return false;
        }

        return true;
    }
}
