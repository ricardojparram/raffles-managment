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

            <button
                type="button"
                class="icon-btn border-line bg-surface relative border"
                x-data="shareLink(@js(['title' => $raffle->title, 'text' => __('Join this raffle: :title', ['title' => $raffle->title]), 'url' => $raffle->publicUrl()]))"
                x-on:click="share()"
                aria-label="{{ __('Share raffle') }}"
            >
                <x-heroicon-o-arrow-up-on-square class="size-5" x-show="! copied" />
                <x-heroicon-m-check class="text-success size-5" x-show="copied" x-cloak />
                <span class="sr-only" role="status" x-text="copied ? @js(__('Link copied')) : ''"></span>
            </button>
        </header>

        <main class="mt-2 space-y-5">
            <section class="card overflow-hidden" aria-labelledby="raffle-title">
                <div class="bg-sunken relative aspect-[4/3]">
                    <x-public.raffle-cover :raffle="$raffle" eager />
                    <x-public.status-pill :status="$status" class="absolute top-3 left-3 shadow-sm" />
                </div>

                <div class="p-5">
                    <h1 id="raffle-title" class="text-[1.625rem] leading-tight font-extrabold tracking-tight text-balance">{{ $raffle->title }}</h1>

                    <dl class="mt-4 grid grid-cols-2 gap-3">
                        <div class="bg-sunken rounded-2xl p-3.5">
                            <dt class="text-ink-faint flex items-center gap-1.5 text-xs font-medium">
                                <x-heroicon-m-ticket class="size-4" />
                                {{ __('Price per ticket') }}
                            </dt>
                            <dd class="mt-1 text-xl font-extrabold tracking-tight tabular-nums">{{ money($raffle->ticket_price, $raffle->currency)->format() }}</dd>
                        </div>
                        <div class="bg-sunken rounded-2xl p-3.5">
                            <dt class="text-ink-faint flex items-center gap-1.5 text-xs font-medium">
                                <x-heroicon-m-calendar-days class="size-4" />
                                {{ __('Draw') }}
                            </dt>
                            <dd class="mt-1 leading-tight">
                                <time datetime="{{ $raffle->date->toIso8601String() }}">
                                    <span class="block font-bold first-letter:uppercase">{{ $shortDate($raffle->date) }}</span>
                                    <span class="text-ink-soft block text-sm">{{ $raffle->date->isoFormat('h:mm a') }}</span>
                                </time>
                            </dd>
                        </div>
                    </dl>

                    @if ($isOpen || ($status === \App\Enums\SalesStatus::SoldOut && $hasFutureDraw))
                        <div class="mt-4" x-data="countdown(@js($raffle->date->toIso8601String()))">
                            <p class="text-ink-faint text-xs font-medium" x-show="! finished">{{ __('Time left until the draw') }}</p>
                            <div class="mt-2 grid grid-cols-4 gap-2 text-center" x-show="! finished" role="timer" aria-live="off">
                                @foreach (['days' => __('days'), 'hours' => __('hours'), 'minutes' => __('min'), 'seconds' => __('sec')] as $unit => $label)
                                    <div class="border-line rounded-2xl border py-2.5">
                                        <span class="block text-xl leading-none font-extrabold tabular-nums" x-text="{{ $unit }}">--</span>
                                        <span class="text-ink-faint mt-1 block text-[0.6875rem] font-medium">{{ $label }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <p class="bg-brand-soft text-brand-ink rounded-2xl px-4 py-3 text-center text-sm font-semibold" x-show="finished" x-cloak>
                                {{ __('It is draw time!') }}
                            </p>
                        </div>
                    @endif

                    @if ($showsProgress)
                        <div class="mt-5">
                            <div class="flex items-baseline justify-between gap-3 text-sm">
                                <span class="font-semibold">{{ __(':percentage% sold', ['percentage' => $percentage]) }}</span>
                                @if ($isAlmostGone)
                                    <span class="text-brand-ink font-semibold">{{ trans_choice('{1} Only :count number left|[2,*] Only :count numbers left', $available, ['count' => $available]) }}</span>
                                @endif
                            </div>
                            <div
                                class="bg-sunken mt-2 h-2.5 overflow-hidden rounded-full"
                                role="progressbar"
                                aria-label="{{ __('Tickets sold') }}"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                aria-valuenow="{{ $percentage }}"
                            >
                                <div class="bg-brand h-full rounded-full" style="width: {{ max(2, $percentage) }}%"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            @unless ($isOpen)
                <section class="card flex items-start gap-3.5 p-5" role="status">
                    <span class="bg-sunken text-ink-soft flex size-11 shrink-0 items-center justify-center rounded-full">
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
                    <h2 id="prizes-title" class="eyebrow mb-3 px-1">{{ __('More prizes') }}</h2>
                    <ul class="scrollbar-none -mx-4 flex snap-x snap-mandatory gap-3 overflow-x-auto px-4 pb-1">
                        @foreach ($raffle->raffle_prizes->sortBy('date') as $prize)
                            <li class="card flex w-[72%] max-w-64 shrink-0 snap-start items-center gap-3 p-3 shadow-none">
                                <span class="bg-brand-soft text-brand-ink flex size-12 shrink-0 items-center justify-center overflow-hidden rounded-2xl">
                                    @if ($prizeImage = $prize->imageUrl())
                                        <img src="{{ $prizeImage }}" alt="" class="size-full object-cover" loading="lazy" decoding="async" width="96" height="96">
                                    @else
                                        <x-heroicon-o-gift class="size-6" />
                                    @endif
                                </span>
                                <span class="min-w-0 leading-tight">
                                    <span class="block truncate font-bold">{{ $prize->title }}</span>
                                    @if ($prize->date)
                                        <span class="text-ink-faint mt-0.5 block text-xs first-letter:uppercase">{{ $shortDate($prize->date) }}, {{ $prize->date->isoFormat('h:mm a') }}</span>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            @if ($isOpen)
                <livewire:ticket-purchase :raffle="$raffle" />
            @endif

            @if (filled($description))
                <section class="card p-5" aria-labelledby="details-title" x-data="expandable">
                    <h2 id="details-title" class="text-lg font-bold">{{ __('Details') }}</h2>
                    <div class="relative mt-3">
                        <div x-ref="content" class="rich-text overflow-hidden" x-bind:class="expanded ? '' : 'max-h-56'">
                            {!! $description !!}
                        </div>
                        <div class="from-surface pointer-events-none absolute inset-x-0 bottom-0 h-16 bg-linear-to-t to-transparent" x-show="overflowing && ! expanded" x-cloak></div>
                    </div>
                    <button type="button" class="text-brand-ink mt-3 text-sm font-semibold" x-show="overflowing" x-cloak x-on:click="expanded = ! expanded" x-bind:aria-expanded="expanded">
                        <span x-text="expanded ? @js(__('Show less')) : @js(__('Read more'))"></span>
                    </button>
                </section>
            @endif

            @if ($isOpen && $paymentMethods->isNotEmpty())
                <section aria-labelledby="methods-title">
                    <h2 id="methods-title" class="eyebrow mb-3 px-1">{{ __('Ways to pay') }}</h2>
                    <ul class="flex flex-wrap gap-2">
                        @foreach ($paymentMethods as $method)
                            <li class="border-line bg-surface flex items-center gap-2 rounded-full border py-1.5 pr-3.5 pl-1.5 text-sm font-medium">
                                <span class="bg-sunken flex size-7 shrink-0 items-center justify-center overflow-hidden rounded-full">
                                    @if ($icon = $method->iconUrl())
                                        <img src="{{ $icon }}" alt="" class="size-full object-cover" loading="lazy" decoding="async" width="56" height="56">
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
