<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Revoltify\Subscriptionify\Models\Plan;

class UpgradePlan extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-arrow-trending-up';

    protected static \UnitEnum|string|null $navigationGroup = null;

    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.pages.upgrade-plan';

    public static function getNavigationLabel(): string
    {
        return __('Upgrade Plan');
    }
    protected static ?string $slug = 'upgrade-plan';

    public function getTitle(): string
    {
        return __('Upgrade Your Plan');
    }

    public function getViewData(): array
    {
        $team = Filament::getTenant();
        $currentPlan = $team?->subscription()?->getPlan();

        $plans = Plan::where('is_active', true)
            ->orderBy('sort_order')
            ->with('features')
            ->get()
            // Group by base plan name (remove monthly/yearly suffix)
            ->groupBy(function (Plan $plan) {
                return str($plan->slug)->beforeLast('-')->toString();
            });

        return [
            'team'        => $team,
            'currentPlan' => $currentPlan,
            'plans'       => $plans,
            'features'    => $team?->allFeatures() ?? collect(),
        ];
    }

    public function checkoutAction(): \Filament\Actions\Action
    {
        return \Filament\Actions\Action::make('checkout')
            ->label(fn(array $arguments) => Plan::find($arguments['plan_id'] ?? null)?->hasTrialDays() ? __('Start :days-day Trial', ['days' => Plan::find($arguments['plan_id'] ?? null)?->getTrialDays()]) : __('Upgrade'))
            ->extraAttributes(['class' => 'w-full'])
            ->modalHeading(fn (array $arguments) => 'Checkout for ' . (Plan::find($arguments['plan_id'] ?? null)?->name ?? 'Plan'))
            ->form([
                \Filament\Forms\Components\Radio::make('payment_method')
                    ->options([
                        'paypal' => 'PayPal',
                        'pagomovil' => 'Pago Móvil / Transferencia',
                    ])
                    ->required()
                    ->live(),
                \Filament\Forms\Components\TextInput::make('reference')
                    ->label('Referencia de Pago')
                    ->required(fn (\Filament\Forms\Get $get) => $get('payment_method') === 'pagomovil')
                    ->visible(fn (\Filament\Forms\Get $get) => $get('payment_method') === 'pagomovil'),
                \Filament\Forms\Components\FileUpload::make('receipt_image')
                    ->label('Comprobante de Pago')
                    ->image()
                    ->directory('receipts')
                    ->visible(fn (\Filament\Forms\Get $get) => $get('payment_method') === 'pagomovil'),
            ])
            ->action(function (array $arguments, array $data) {
                $plan = Plan::findOrFail($arguments['plan_id']);
                $team = Filament::getTenant();

                if ($data['payment_method'] === 'paypal') {
                    // Redirect to PayPal or handle automatic subscription
                    // For now, we simulate success
                    $team->subscribe($plan);
                    \Filament\Notifications\Notification::make()
                        ->title('Suscripción activa')
                        ->success()
                        ->send();
                } else {
                    // Offline payment, create record for admin review
                    \App\Models\SubscriptionPayment::create([
                        'team_id' => $team->id,
                        'plan_id' => $plan->id,
                        'amount' => $plan->price,
                        'currency' => $plan->currency ?? 'USD',
                        'payment_method' => $data['payment_method'],
                        'reference' => $data['reference'] ?? null,
                        'receipt_image' => $data['receipt_image'] ?? null,
                        'status' => 'pending',
                    ]);

                    \Filament\Notifications\Notification::make()
                        ->title('Pago registrado')
                        ->body('Tu pago está en revisión. Te notificaremos cuando se apruebe.')
                        ->success()
                        ->send();
                }
            });
    }
}
