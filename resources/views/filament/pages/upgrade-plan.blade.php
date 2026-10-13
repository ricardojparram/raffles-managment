<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Current Plan Info --}}
        @if($currentPlan)
            <x-filament::section>
                <x-slot name="heading">
                    {{ __('Current Plan') }}
                </x-slot>
                <div class="flex items-center gap-4">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $currentPlan->getName() }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $currentPlan->getDescription() }}</p>
                    </div>
                    @if($currentPlan->isFree())
                        <x-filament::badge color="gray">{{ __('Free') }}</x-filament::badge>
                    @else
                        <x-filament::badge color="success">{{ __('Active') }}</x-filament::badge>
                    @endif
                </div>

                {{-- Current Usage --}}
                @if($features->isNotEmpty())
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($features as $feature)
                            <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ $feature->name }}
                                </div>
                                @if($feature->unlimited)
                                    <div class="text-lg font-semibold text-green-600 dark:text-green-400">
                                        {{ __('Unlimited') }}
                                    </div>
                                @elseif($feature->type === 'toggle')
                                    <div class="text-lg font-semibold">
                                        <x-filament::badge :color="$feature->applicable ? 'success' : 'danger'">
                                            {{ $feature->applicable ? __('Enabled') : __('Disabled') }}
                                        </x-filament::badge>
                                    </div>
                                @else
                                    <div class="text-lg font-semibold">
                                        {{ $feature->used ?? 0 }} / {{ $feature->limit ?? '∞' }}
                                    </div>
                                    @if(isset($feature->limit) && $feature->limit > 0)
                                        <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                            @php
                                                $percentage = min(100, (($feature->used ?? 0) / $feature->limit) * 100);
                                                $color = $percentage >= 90 ? 'bg-red-500' : ($percentage >= 70 ? 'bg-yellow-500' : 'bg-primary-500');
                                            @endphp
                                            <div class="{{ $color }} h-2 rounded-full transition-all duration-300"
                                                 style="width: {{ $percentage }}%"></div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-filament::section>
        @endif

        {{-- Available Plans --}}
        <x-filament::section>
            <x-slot name="heading">
                {{ __('Available Plans') }}
            </x-slot>
            <x-slot name="description">
                {{ __('Choose the plan that best fits your needs. All paid plans include a 7-day free trial.') }}
            </x-slot>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-4">
                @foreach($plans as $baseName => $planGroup)
                    @php
                        $plan = $planGroup->first(); // Show the monthly variant
                    @endphp
                    <div @class([
                        'rounded-xl border-2 p-6 transition-all duration-200',
                        'border-primary-500 bg-primary-50/50 dark:bg-primary-950/20 shadow-lg' => $currentPlan && $currentPlan->getKey() === $plan->getKey(),
                        'border-gray-200 dark:border-gray-700 hover:border-primary-300 dark:hover:border-primary-700' => !$currentPlan || $currentPlan->getKey() !== $plan->getKey(),
                    ])>
                        <h3 class="text-xl font-bold">{{ $plan->getName() }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $plan->getDescription() }}</p>

                        <div class="mt-4">
                            @if($plan->isFree())
                                <span class="text-3xl font-bold">{{ __('Free') }}</span>
                            @else
                                <span class="text-3xl font-bold">$--</span>
                                <span class="text-gray-500 dark:text-gray-400">/{{ __('month') }}</span>
                            @endif
                        </div>

                        <ul class="mt-6 space-y-3">
                            @foreach($plan->features as $feature)
                                <li class="flex items-center gap-2 text-sm">
                                    @if($feature->pivot->value === null && $feature->type->value === 'toggle')
                                        <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 flex-shrink-0"/>
                                        <span>{{ $feature->getName() }}</span>
                                    @elseif($feature->pivot->value === null)
                                        <x-heroicon-o-check-circle class="w-5 h-5 text-primary-500 flex-shrink-0"/>
                                        <span>{{ __('Unlimited') }} {{ $feature->getName() }}</span>
                                    @else
                                        <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 flex-shrink-0"/>
                                        <span>{{ $feature->pivot->value }} {{ $feature->getName() }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-6">
                            @if($currentPlan && $currentPlan->getKey() === $plan->getKey())
                                <x-filament::button color="gray" disabled class="w-full">
                                    {{ __('Current Plan') }}
                                </x-filament::button>
                            @elseif($plan->isFree())
                                <x-filament::button color="gray" class="w-full" disabled>
                                    {{ __('Free') }}
                                </x-filament::button>
                            @else
                                {{ ($this->checkoutAction)(['plan_id' => $plan->id]) }}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
