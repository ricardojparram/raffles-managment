@php
    $isOpen = $status->isOpen();
    $hasFutureDraw = $raffle->date->isFuture();
    $percentage = $raffle->soldPercentage();
    $available = $raffle->availableTicketsCount();
    $isAlmostGone = $isOpen && $available <= max(1, (int) floor($raffle->ticket_amount * 0.2));
    $showsProgress = $isOpen || $status === \App\Enums\SalesStatus::SoldOut;
    $shortDate = fn (\Carbon\CarbonInterface $date): string => str_replace('.', '', $date->isoFormat('ddd D MMM'));
@endphp

<x-layouts.public
    :title="$raffle->title"
    :description="$summary"
    :image="$raffle->imageUrl()"
    :url="$raffle->publicUrl()"
>
    <div @class(['mx-auto w-full max-w-xl px-4 pt-2 sm:pt-6', 'pb-36' => $isOpen, 'pb-12' => ! $isOpen])>
        <header class="flex items-center justify-between gap-3 py-2">
            <x-public.organizer :team="$team" :href="route('raffles.index', $team)" />

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    class="btn btn-secondary btn-sm flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-bold"
                    x-data="copyable(@js($raffle->toShareText($paymentMethods)))"
                    x-on:click="copy()"
                    aria-label="{{ __('Copiar datos de la rifa') }}"
                    title="{{ __('Copiar datos de la rifa para WhatsApp') }}"
                >
                    <x-heroicon-o-clipboard-document-list class="size-4" x-show="! copied" />
                    <x-heroicon-m-check class="text-brand-ink size-4" x-show="copied" x-cloak />
                    <span x-text="copied ? @js(__('¡Copiado!')) : @js(__('Copiar datos'))">{{ __('Copiar datos') }}</span>
                </button>

                <button
                    type="button"
                    class="icon-btn"
                    x-data="shareLink(@js(['title' => $raffle->title, 'text' => __('Join this raffle: :title', ['title' => $raffle->title]), 'url' => $raffle->publicUrl()]))"
                    x-on:click="share()"
                    aria-label="{{ __('Share raffle') }}"
                >
                    <x-heroicon-o-arrow-up-on-square class="size-5" x-show="! copied" />
                    <x-heroicon-m-check class="text-brand-ink size-5" x-show="copied" x-cloak />
                    <span class="sr-only" role="status" x-text="copied ? @js(__('Link copied')) : ''"></span>
                </button>
            </div>
        </header>

        <main class="mt-2 space-y-8">
            <section aria-labelledby="raffle-title">
                <div class="bg-sunken relative aspect-[4/3] overflow-hidden rounded-2xl">
                    <x-public.raffle-cover :raffle="$raffle" eager />
                    <x-public.status-pill :status="$status" solid class="absolute top-3 left-3" />
                </div>

                <h1 id="raffle-title" class="mt-5 text-[1.625rem] leading-[1.15] font-extrabold tracking-tight text-balance">{{ $raffle->title }}</h1>

                @if (filled($raffle->conalot_permit))
                    <div class="mt-2.5 inline-flex items-center gap-1.5 rounded-full bg-brand-soft px-3 py-1 text-xs font-bold text-brand">
                        <x-heroicon-m-shield-check class="size-4 shrink-0" />
                        <span>{{ __('Autorización CONALOT: :code', ['code' => $raffle->conalot_permit]) }}</span>
                    </div>
                @endif

                <dl class="border-line divide-line mt-5 grid grid-cols-2 divide-x rounded-2xl border">
                    <div class="p-4">
                        <dt class="caption">{{ __('Price per ticket') }}</dt>
                        <dd class="mt-1 text-2xl leading-none font-extrabold tracking-tight tabular-nums">{{ money($raffle->ticket_price, $raffle->currency)->format() }}</dd>
                    </div>
                    <div class="p-4">
                        <dt class="caption">{{ __('Draw') }}</dt>
                        <dd class="mt-1 leading-tight">
                            <time datetime="{{ $raffle->date->toIso8601String() }}">
                                <span class="block text-base font-bold first-letter:uppercase">{{ $shortDate($raffle->date) }}</span>
                                <span class="text-ink-soft block text-sm">{{ $raffle->date->isoFormat('h:mm a') }}</span>
                            </time>
                        </dd>
                    </div>
                </dl>

                @if ($isOpen || ($status === \App\Enums\SalesStatus::SoldOut && $hasFutureDraw))
                    <div class="mt-5" x-data="countdown(@js($raffle->date->toIso8601String()))">
                        <p class="caption" x-show="! finished">{{ __('Time left until the draw') }}</p>
                        <div class="mt-2 grid grid-cols-4 gap-2 text-center" x-show="! finished" role="timer" aria-live="off">
                            @foreach (['days' => __('days'), 'hours' => __('hours'), 'minutes' => __('min'), 'seconds' => __('sec')] as $unit => $label)
                                <div class="bg-sunken rounded-xl py-2.5">
                                    <span class="block text-xl leading-none font-extrabold tabular-nums" x-text="{{ $unit }}">--</span>
                                    <span class="text-ink-faint mt-1 block text-[0.6875rem] font-medium">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                        <p class="bg-brand-soft text-brand-ink rounded-xl px-4 py-3 text-center text-sm font-bold" x-show="finished" x-cloak>
                            {{ __('It is draw time!') }}
                        </p>
                    </div>
                @endif

                @if ($showsProgress)
                    <div class="mt-5">
                        <div class="flex items-baseline justify-between gap-3 text-sm">
                            <span class="font-bold">{{ __(':percentage% sold', ['percentage' => $percentage]) }}</span>
                            @if ($isAlmostGone)
                                <span class="text-brand-ink font-bold">{{ trans_choice('{1} Only :count number left|[2,*] Only :count numbers left', $available, ['count' => $available]) }}</span>
                            @endif
                        </div>
                        <x-public.progress :percentage="$percentage" class="mt-2" />
                    </div>
                @endif
            </section>

            @unless ($isOpen)
                <section class="card flex items-start gap-3.5 p-5" role="status">
                    <span class="bg-sunken text-ink-soft flex size-10 shrink-0 items-center justify-center rounded-full">
                        <x-heroicon-o-lock-closed class="size-5" />
                    </span>
                    <div>
                        <h2 class="font-bold">{{ $status->label() }}</h2>
                        <p class="text-ink-soft mt-0.5 text-sm text-pretty">{{ $status->description() }}</p>
                    </div>
                </section>
            @endunless

            @if ($raffle->raffle_prizes->isNotEmpty())
                <section aria-labelledby="prizes-title">
                    <h2 id="prizes-title" class="section-title mb-3">{{ __('More prizes') }}</h2>
                    <ol class="card divide-line divide-y overflow-hidden">
                        @foreach ($raffle->raffle_prizes->sortBy('date')->values() as $prize)
                            <li class="flex items-center gap-3.5 px-4 py-3.5">
                                <span class="bg-sunken text-ink-soft flex size-11 shrink-0 items-center justify-center overflow-hidden rounded-xl">
                                    @if ($prizeImage = $prize->imageUrl())
                                        <img src="{{ $prizeImage }}" alt="" class="size-full object-cover" loading="lazy" decoding="async" width="88" height="88">
                                    @else
                                        <x-heroicon-o-gift class="size-5" />
                                    @endif
                                </span>
                                <span class="min-w-0 flex-1 leading-tight">
                                    <span class="block font-bold text-balance">{{ $prize->title }}</span>
                                    @if ($prize->date)
                                        <span class="text-ink-faint mt-0.5 block text-[0.8125rem] first-letter:uppercase">{{ $shortDate($prize->date) }}, {{ $prize->date->isoFormat('h:mm a') }}</span>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ol>
                </section>
            @endif

            @if ($isOpen)
                <livewire:ticket-purchase :raffle="$raffle" />
            @endif

            @if (filled($description))
                <section aria-labelledby="details-title" x-data="expandable">
                    <h2 id="details-title" class="section-title">{{ __('Details') }}</h2>
                    <div class="relative mt-3">
                        <div x-ref="content" class="rich-text overflow-hidden" x-bind:class="expanded ? '' : 'max-h-56'">
                            {!! $description !!}
                        </div>
                        <div class="from-canvas pointer-events-none absolute inset-x-0 bottom-0 h-16 bg-linear-to-t to-transparent" x-show="overflowing && ! expanded" x-cloak></div>
                    </div>
                    <button type="button" class="text-brand-ink mt-2 min-h-9 text-sm font-bold" x-show="overflowing" x-cloak x-on:click="expanded = ! expanded" x-bind:aria-expanded="expanded">
                        <span x-text="expanded ? @js(__('Show less')) : @js(__('Read more'))"></span>
                    </button>
                </section>
            @endif

            @if ($isOpen && $paymentMethods->isNotEmpty())
                <section aria-labelledby="methods-title">
                    <div class="mb-3 flex items-center justify-between">
                        <h2 id="methods-title" class="section-title">{{ __('Ways to pay') }}</h2>
                        <button
                            type="button"
                            class="text-brand-ink flex items-center gap-1 text-xs font-bold"
                            x-data="copyable(@js($raffle->toShareText($paymentMethods)))"
                            x-on:click="copy()"
                        >
                            <x-heroicon-o-clipboard-document class="size-4" x-show="! copied" />
                            <x-heroicon-m-check class="text-brand-ink size-4" x-show="copied" x-cloak />
                            <span x-text="copied ? @js(__('¡Copiado!')) : @js(__('Copiar datos'))">{{ __('Copiar datos') }}</span>
                        </button>
                    </div>
                    <ul class="flex flex-wrap gap-2">
                        @foreach ($paymentMethods as $method)
                            <li class="border-line flex items-center gap-2 rounded-full border py-1.5 pr-3.5 pl-1.5 text-sm font-semibold">
                                <span class="bg-sunken flex size-7 shrink-0 items-center justify-center overflow-hidden rounded-full">
                                    @if ($icon = $method->iconUrl())
                                        <img src="{{ $icon }}" alt="" class="size-full object-cover" loading="lazy" decoding="async" width="56" height="56">
                                    @else
                                        <x-heroicon-o-credit-card class="size-4 text-ink-soft" />
                                    @endif
                                </span>
                                {{ $method->title }}
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            <livewire:ticket-checker :raffle="$raffle" />
        </main>

        <x-public.footer :team="$team" />
    </div>
</x-layouts.public>
