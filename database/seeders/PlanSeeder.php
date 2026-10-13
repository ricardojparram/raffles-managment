<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Revoltify\Subscriptionify\Enums\FeatureType;
use Revoltify\Subscriptionify\Models\Feature;
use Revoltify\Subscriptionify\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        // ── Features ───────────────────────────────────────────────
        $features = collect([
            // Limit features (consumed/released on create/delete)
            ['name' => 'Raffles',          'slug' => 'raffles_created', 'type' => FeatureType::Limit,  'sort_order' => 1],
            ['name' => 'Customers',        'slug' => 'customers',       'type' => FeatureType::Limit,  'sort_order' => 2],
            ['name' => 'Team Members',     'slug' => 'team_members',    'type' => FeatureType::Limit,  'sort_order' => 3],

            // Toggle features (on/off per plan)
            ['name' => 'Advanced Reports', 'slug' => 'advanced_reports', 'type' => FeatureType::Toggle, 'sort_order' => 4],
            ['name' => 'Custom Branding',  'slug' => 'custom_branding',  'type' => FeatureType::Toggle, 'sort_order' => 5],
            ['name' => 'API Access',       'slug' => 'api_access',       'type' => FeatureType::Toggle, 'sort_order' => 6],
        ])->mapWithKeys(function (array $data) {
            $feature = Feature::updateOrCreate(
                ['slug' => $data['slug']],
                $data,
            );

            return [$data['slug'] => $feature];
        });

        // ── Plans ──────────────────────────────────────────────────
        $plans = [
            [
                'name'             => 'Free',
                'slug'             => 'free',
                'description'      => 'Perfect for individuals getting started with raffles.',
                'is_free'          => true,
                'is_active'        => true,
                'trial_days'       => 0,
                'billing_period'   => 1,
                'billing_interval' => 'month',
                'grace_days'       => 0,
                'sort_order'       => 1,
                'features'         => [
                    'raffles_created'  => ['value' => 3],
                    'customers'        => ['value' => 50],
                    'team_members'     => ['value' => 1],
                    // advanced_reports, custom_branding, api_access → NOT attached = OFF
                ],
            ],
            [
                'name'             => 'Starter',
                'slug'             => 'starter-monthly',
                'description'      => 'For small organizations starting to grow.',
                'is_free'          => false,
                'is_active'        => true,
                'trial_days'       => 7,
                'billing_period'   => 1,
                'billing_interval' => 'month',
                'grace_days'       => 3,
                'sort_order'       => 2,
                'features'         => [
                    'raffles_created'   => ['value' => '15'],
                    'customers'         => ['value' => '300'],
                    'team_members'      => ['value' => '5'],
                    'advanced_reports'  => ['value' => '1'],
                ],
            ],
            [
                'name'             => 'Starter (Annual)',
                'slug'             => 'starter-yearly',
                'description'      => 'Starter plan billed annually. Save 20%!',
                'is_free'          => false,
                'is_active'        => true,
                'trial_days'       => 7,
                'billing_period'   => 1,
                'billing_interval' => 'year',
                'grace_days'       => 7,
                'sort_order'       => 3,
                'features'         => [
                    'raffles_created'   => ['value' => '15'],
                    'customers'         => ['value' => '300'],
                    'team_members'      => ['value' => '5'],
                    'advanced_reports'  => ['value' => '1'],
                ],
            ],
            [
                'name'             => 'Pro',
                'slug'             => 'pro-monthly',
                'description'      => 'For established organizations with high volume.',
                'is_free'          => false,
                'is_active'        => true,
                'trial_days'       => 7,
                'billing_period'   => 1,
                'billing_interval' => 'month',
                'grace_days'       => 5,
                'sort_order'       => 4,
                'features'         => [
                    'raffles_created'   => ['value' => '50'],
                    'customers'         => ['value' => '1000'],
                    'team_members'      => ['value' => '15'],
                    'advanced_reports'  => ['value' => '1'],
                    'custom_branding'   => ['value' => '1'],
                ],
            ],
            [
                'name'             => 'Pro (Annual)',
                'slug'             => 'pro-yearly',
                'description'      => 'Pro plan billed annually. Save 20%!',
                'is_free'          => false,
                'is_active'        => true,
                'trial_days'       => 7,
                'billing_period'   => 1,
                'billing_interval' => 'year',
                'grace_days'       => 7,
                'sort_order'       => 5,
                'features'         => [
                    'raffles_created'   => ['value' => '50'],
                    'customers'         => ['value' => '1000'],
                    'team_members'      => ['value' => '15'],
                    'advanced_reports'  => ['value' => '1'],
                    'custom_branding'   => ['value' => '1'],
                ],
            ],
            [
                'name'             => 'Enterprise',
                'slug'             => 'enterprise-monthly',
                'description'      => 'Unlimited everything. Custom support.',
                'is_free'          => false,
                'is_active'        => true,
                'trial_days'       => 7,
                'billing_period'   => 1,
                'billing_interval' => 'month',
                'grace_days'       => 15,
                'sort_order'       => 6,
                'features'         => [
                    'raffles_created'   => ['value' => \Revoltify\Subscriptionify\Services\FeatureService::UNLIMITED],
                    'customers'         => ['value' => \Revoltify\Subscriptionify\Services\FeatureService::UNLIMITED],
                    'team_members'      => ['value' => \Revoltify\Subscriptionify\Services\FeatureService::UNLIMITED],
                    'advanced_reports'  => ['value' => '1'],
                    'custom_branding'   => ['value' => '1'],
                    'api_access'        => ['value' => '1'],
                ],
            ],
            [
                'name'             => 'Enterprise (Annual)',
                'slug'             => 'enterprise-yearly',
                'description'      => 'Enterprise plan billed annually. Save 20%!',
                'is_free'          => false,
                'is_active'        => true,
                'trial_days'       => 7,
                'billing_period'   => 1,
                'billing_interval' => 'year',
                'grace_days'       => 15,
                'sort_order'       => 7,
                'features'         => [
                    'raffles_created'   => ['value' => \Revoltify\Subscriptionify\Services\FeatureService::UNLIMITED],
                    'customers'         => ['value' => \Revoltify\Subscriptionify\Services\FeatureService::UNLIMITED],
                    'team_members'      => ['value' => \Revoltify\Subscriptionify\Services\FeatureService::UNLIMITED],
                    'advanced_reports'  => ['value' => '1'],
                    'custom_branding'   => ['value' => '1'],
                    'api_access'        => ['value' => '1'],
                ],
            ],
        ];

        foreach ($plans as $planData) {
            $planFeatures = $planData['features'];
            unset($planData['features']);

            $plan = Plan::updateOrCreate(
                ['slug' => $planData['slug']],
                $planData,
            );

            // Sync features with their pivot values
            $syncData = [];
            foreach ($planFeatures as $featureSlug => $pivotData) {
                if ($features->has($featureSlug)) {
                    $syncData[$features[$featureSlug]->id] = $pivotData;
                }
            }

            $plan->features()->sync($syncData);
        }
    }
}
