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
    <div @class(['mx-auto w-full max-w-xl px-4 pt-2 sm:pt-6', 'pb-36' => $isOpen, 'pb-12' => ! $isOpen]) x-data="{ shareModalOpen: false }">
        <header class="flex items-center justify-between gap-3 py-2">
            <x-public.organizer :team="$team" :href="route('raffles.index', $team)" />

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    class="icon-btn"
                    x-on:click="shareModalOpen = true"
                    aria-label="{{ __('Share raffle') }}"
                    title="{{ __('Share raffle') }}"
                >
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="18" cy="5" r="3"/>
                        <circle cx="6" cy="12" r="3"/>
                        <circle cx="18" cy="19" r="3"/>
                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                    </svg>
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
                    <div class="card mt-5 overflow-hidden p-4 sm:p-5" x-data="countdown(@js($raffle->date->toIso8601String()))">
                        <div class="mb-3.5 flex items-center justify-between" x-show="! finished">
                            <div class="flex items-center gap-2">
                                <span class="relative flex size-2.5">
                                    <span class="animate-ping absolute inline-flex size-full rounded-full bg-brand opacity-75"></span>
                                    <span class="relative inline-flex size-2.5 rounded-full bg-brand"></span>
                                </span>
                                <span class="caption text-[0.7rem] font-extrabold uppercase tracking-wider text-ink">{{ __('Faltan para el sorteo') }}</span>
                            </div>
                            <span class="text-ink-faint flex items-center gap-1.5 text-xs font-semibold">
                                <x-heroicon-o-clock class="text-brand size-4 shrink-0" />
                                <span class="first-letter:uppercase">{{ $shortDate($raffle->date) }}, {{ $raffle->date->isoFormat('h:mm a') }}</span>
                            </span>
                        </div>

                        <div class="grid grid-cols-[1fr_auto_1fr_auto_1fr_auto_1fr] items-center gap-1 sm:gap-2" x-show="! finished" role="timer" aria-live="off">
                            {{-- Días --}}
                            <div class="bg-sunken rounded-2xl py-3 px-1 sm:py-3.5 flex flex-col items-center justify-center text-center shadow-2xs">
                                <span class="text-ink font-mono text-2xl sm:text-3xl font-black tracking-tight tabular-nums leading-none" x-text="days">--</span>
                                <span class="text-ink-faint mt-1.5 text-[0.625rem] sm:text-[0.6875rem] font-extrabold uppercase tracking-wider leading-none">{{ __('Días') }}</span>
                            </div>

                            {{-- Colon 1 --}}
                            <div class="flex flex-col items-center justify-center gap-1.5 select-none -translate-y-2 sm:-translate-y-2.5" aria-hidden="true">
                                <span class="size-1.5 rounded-full bg-brand"></span>
                                <span class="size-1.5 rounded-full bg-brand"></span>
                            </div>

                            {{-- Horas --}}
                            <div class="bg-sunken rounded-2xl py-3 px-1 sm:py-3.5 flex flex-col items-center justify-center text-center shadow-2xs">
                                <span class="text-ink font-mono text-2xl sm:text-3xl font-black tracking-tight tabular-nums leading-none" x-text="hours">--</span>
                                <span class="text-ink-faint mt-1.5 text-[0.625rem] sm:text-[0.6875rem] font-extrabold uppercase tracking-wider leading-none">{{ __('Horas') }}</span>
                            </div>

                            {{-- Colon 2 --}}
                            <div class="flex flex-col items-center justify-center gap-1.5 select-none -translate-y-2 sm:-translate-y-2.5" aria-hidden="true">
                                <span class="size-1.5 rounded-full bg-brand"></span>
                                <span class="size-1.5 rounded-full bg-brand"></span>
                            </div>

                            {{-- Minutos --}}
                            <div class="bg-sunken rounded-2xl py-3 px-1 sm:py-3.5 flex flex-col items-center justify-center text-center shadow-2xs">
                                <span class="text-ink font-mono text-2xl sm:text-3xl font-black tracking-tight tabular-nums leading-none" x-text="minutes">--</span>
                                <span class="text-ink-faint mt-1.5 text-[0.625rem] sm:text-[0.6875rem] font-extrabold uppercase tracking-wider leading-none">{{ __('Min') }}</span>
                            </div>

                            {{-- Colon 3 --}}
                            <div class="flex flex-col items-center justify-center gap-1.5 select-none -translate-y-2 sm:-translate-y-2.5" aria-hidden="true">
                                <span class="size-1.5 rounded-full bg-brand"></span>
                                <span class="size-1.5 rounded-full bg-brand"></span>
                            </div>

                            {{-- Segundos --}}
                            <div class="bg-sunken rounded-2xl py-3 px-1 sm:py-3.5 flex flex-col items-center justify-center text-center shadow-2xs">
                                <span class="text-brand font-mono text-2xl sm:text-3xl font-black tracking-tight tabular-nums leading-none" x-text="seconds">--</span>
                                <span class="text-ink-faint mt-1.5 text-[0.625rem] sm:text-[0.6875rem] font-extrabold uppercase tracking-wider leading-none">{{ __('Seg') }}</span>
                            </div>
                        </div>

                        <div class="bg-brand-soft text-brand-ink rounded-xl px-4 py-3 text-center text-sm font-bold flex items-center justify-center gap-2" x-show="finished" x-cloak>
                            <x-heroicon-m-sparkles class="size-5 shrink-0" />
                            <span>{{ __('¡Llegó la hora del sorteo!') }}</span>
                        </div>
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

            {{-- Finished Raffle / Winning Numbers Banner --}}
            @if ($status === \App\Enums\SalesStatus::Finished || $raffle->hasWinningNumbers())
                <section class="card overflow-hidden border-2 border-amber-500/30 bg-linear-to-b from-amber-500/10 via-canvas to-canvas p-5 sm:p-6 shadow-xl" role="region" aria-labelledby="winners-section-title">
                    <div class="flex items-center gap-2.5">
                        <span class="flex size-9 items-center justify-center rounded-full bg-amber-500/20 text-amber-500 dark:text-amber-400">
                            <x-heroicon-s-trophy class="size-5" />
                        </span>
                        <div>
                            <span class="caption text-[0.7rem] font-extrabold uppercase tracking-wider text-amber-600 dark:text-amber-400">{{ __('Resultado oficial del sorteo') }}</span>
                            <h2 id="winners-section-title" class="text-lg font-black tracking-tight text-ink">{{ __('¡Números Ganadores!') }}</h2>
                            <p class="text-ink-soft text-xs mt-0.5">{{ $status->description() }}</p>
                        </div>
                    </div>

                    {{-- Premio Mayor --}}
                    <div class="mt-4 rounded-2xl bg-sunken p-4 border border-line">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <span class="text-ink-faint text-xs font-bold uppercase tracking-wider block">{{ __('Premio Mayor') }}</span>
                                <span class="text-base font-extrabold text-ink block mt-0.5">{{ $raffle->title }}</span>
                            </div>

                            @if (! empty($raffle->winningNumbers()))
                                <div class="flex flex-wrap items-center gap-2">
                                    @foreach ($raffle->winningNumbers() as $winNum)
                                        <div class="inline-flex items-center gap-2 rounded-xl bg-amber-500/20 border border-amber-500/40 px-3.5 py-1.5 shadow-xs">
                                            <x-heroicon-s-ticket class="size-5 text-amber-500 dark:text-amber-400 shrink-0" />
                                            <span class="font-mono text-xl sm:text-2xl font-black text-amber-600 dark:text-amber-400 tracking-wider tabular-nums">{{ $winNum }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-ink-soft text-xs italic">{{ __('Sorteo finalizado • Número por publicar') }}</span>
                            @endif
                        </div>

                        @if (! empty($raffle->winningNumbers()))
                            @php
                                $winningTickets = $raffle->tickets()->with('customer')->whereIn('number', $raffle->winningNumbers())->get();
                            @endphp
                            @if ($winningTickets->isNotEmpty())
                                <div class="mt-3 pt-3 border-t border-line/60 flex flex-wrap gap-2 items-center text-xs text-ink-soft">
                                    <span class="font-bold text-ink">{{ __('Boleto ganador vendido a:') }}</span>
                                    @foreach ($winningTickets as $winTicket)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-canvas border border-line px-2.5 py-0.5 font-semibold text-ink">
                                            <span>{{ $winTicket->customer?->fullname ? \Illuminate\Support\Str::mask($winTicket->customer->fullname, '*', 2, -2) : __('Comprador registrado') }}</span>
                                            <span class="font-mono text-ink-faint">({{ $winTicket->number }})</span>
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>

                    {{-- Premios adicionales con números ganadores --}}
                    @if ($raffle->raffle_prizes->whereNotNull('winning_number')->isNotEmpty())
                        <div class="mt-4 space-y-2">
                            <span class="text-ink-faint text-xs font-bold uppercase tracking-wider block px-1">{{ __('Más Premios Sorteados') }}</span>
                            <div class="grid grid-cols-1 gap-2">
                                @foreach ($raffle->raffle_prizes as $prize)
                                    @if (filled($prize->winning_number))
                                        <div class="flex items-center justify-between gap-3 rounded-xl bg-sunken/60 border border-line p-3">
                                            <div class="flex items-center gap-2.5 min-w-0">
                                                <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-canvas text-amber-500 dark:text-amber-400">
                                                    <x-heroicon-o-gift class="size-4" />
                                                </span>
                                                <span class="text-xs font-bold text-ink truncate">{{ $prize->title }}</span>
                                            </div>
                                            <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-500/15 border border-amber-500/30 px-2.5 py-1 shrink-0">
                                                <span class="text-[10px] uppercase font-bold text-amber-600 dark:text-amber-400">{{ __('Ganador') }}</span>
                                                <span class="font-mono text-sm font-black text-amber-600 dark:text-amber-400 tabular-nums">{{ $prize->winning_number }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </section>
            @elseif (! $isOpen)
                <section class="card flex items-start gap-3.5 p-5" role="status">
                    <span class="bg-sunken text-ink-soft flex size-10 shrink-0 items-center justify-center rounded-full">
                        <x-heroicon-o-lock-closed class="size-5" />
                    </span>
                    <div>
                        <h2 class="font-bold">{{ $status->label() }}</h2>
                        <p class="text-ink-soft mt-0.5 text-sm text-pretty">{{ $status->description() }}</p>
                    </div>
                </section>
            @endif

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
                                    @if (filled($prize->winning_number))
                                        <span class="mt-1 inline-flex items-center gap-1 rounded-md bg-amber-500/15 text-amber-600 dark:text-amber-400 px-2 py-0.5 text-xs font-bold font-mono">
                                            <x-heroicon-m-trophy class="size-3.5" />
                                            <span>{{ __('Ganador: :number', ['number' => $prize->winning_number]) }}</span>
                                        </span>
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
                    </div>
                    <ul class="flex flex-wrap gap-2">
                        @foreach ($paymentMethods as $method)
                            <li class="border-line flex items-center gap-2 rounded-full border py-1.5 px-3.5 text-sm font-semibold">
                                <x-public.payment-icon :method="$method" class="size-5 shrink-0" />
                                <span>{{ $method->title }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            <livewire:ticket-checker :raffle="$raffle" />
        </main>

        <x-public.footer :team="$team" />

        {{-- Share Modal (inside the Alpine component container) --}}
        <div
            x-show="shareModalOpen"
            x-cloak
            x-on:keydown.escape.window="shareModalOpen = false"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-xs"
            role="dialog"
            aria-modal="true"
            aria-labelledby="share-modal-title"
        >
            {{-- Backdrop click --}}
            <div class="fixed inset-0" x-on:click="shareModalOpen = false"></div>

            {{-- Modal Dialog Card --}}
            <div
                x-show="shareModalOpen"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                x-on:click.stop
                class="card relative z-10 w-full max-w-sm overflow-hidden p-5 sm:p-6 shadow-2xl"
            >
                {{-- Header --}}
                <div class="flex items-center justify-between pb-3 border-b border-line">
                    <div class="flex items-center gap-2">
                        <svg class="size-5 text-brand" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="18" cy="5" r="3"/>
                            <circle cx="6" cy="12" r="3"/>
                            <circle cx="18" cy="19" r="3"/>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                        </svg>
                        <h3 id="share-modal-title" class="font-bold text-base">{{ __('Compartir rifa') }}</h3>
                    </div>
                    <button
                        type="button"
                        class="icon-btn size-8 text-ink-soft hover:text-ink"
                        x-on:click="shareModalOpen = false"
                        aria-label="{{ __('Cerrar') }}"
                    >
                        <x-heroicon-m-x-mark class="size-5" />
                    </button>
                </div>

                {{-- QR Code in Center --}}
                <div class="my-5 flex flex-col items-center justify-center text-center">
                    <div class="bg-white p-3 rounded-2xl shadow-sm border border-neutral-200 inline-block">
                        <img src="{{ $raffle->qrCodeDataUri() }}" alt="{{ __('Código QR de la rifa') }}" class="size-44 sm:size-48 block" />
                    </div>
                    <p class="text-ink-faint text-xs font-semibold mt-2.5 flex items-center gap-1.5">
                        <x-heroicon-o-camera class="size-4 text-brand shrink-0" />
                        <span>{{ __('Escaneá con tu celular para abrir la rifa') }}</span>
                    </p>
                </div>

                {{-- Copy link --}}
                <div class="space-y-1.5" x-data="copyable(@js($raffle->publicUrl()))">
                    <label class="caption block font-bold text-xs">{{ __('Enlace directo') }}</label>
                    <div class="relative flex items-center">
                        <input
                            type="text"
                            readonly
                            value="{{ $raffle->publicUrl() }}"
                            class="field text-xs pr-24 font-mono select-all truncate bg-sunken"
                            x-on:focus="$event.target.select()"
                        />
                        <button
                            type="button"
                            class="btn btn-primary btn-sm absolute right-1.5 min-h-8 px-3 font-bold gap-1 shadow-xs"
                            x-on:click="copy()"
                        >
                            <x-heroicon-o-clipboard-document class="size-4" x-show="! copied" />
                            <x-heroicon-m-check class="text-on-brand size-4" x-show="copied" x-cloak />
                            <span x-text="copied ? @js(__('¡Copiado!')) : @js(__('Copiar'))">{{ __('Copiar') }}</span>
                        </button>
                    </div>
                </div>

                {{-- Social networks --}}
                <div class="mt-4">
                    <label class="caption block font-bold text-xs mb-2">{{ __('Compartir en redes') }}</label>
                    <div class="grid grid-cols-2 gap-2">
                        {{-- WhatsApp --}}
                        <a
                            href="https://api.whatsapp.com/send?text={{ rawurlencode('🎟️ '.$raffle->title."\n\n👉 Participa aquí: ".$raffle->publicUrl()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-center gap-2 rounded-xl bg-[#25D366]/15 hover:bg-[#25D366]/25 text-[#25D366] py-2.5 px-3 text-xs font-bold transition-colors shadow-xs"
                        >
                            <svg class="size-4 shrink-0 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M19.05 4.91A9.816 9.816 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01zm-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.264 8.264 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.25-8.24c2.2 0 4.27.86 5.82 2.42a8.182 8.182 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.23 8.23zm4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.79.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.84-.86 2.05s.88 2.38 1 2.55c.12.17 1.74 2.65 4.21 3.72c.59.25 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18c-.06-.1-.22-.16-.47-.28z"/>
                            </svg>
                            <span>WhatsApp</span>
                        </a>

                        {{-- Telegram --}}
                        <a
                            href="https://t.me/share/url?url={{ rawurlencode($raffle->publicUrl()) }}&text={{ rawurlencode('🎟️ '.$raffle->title) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-center gap-2 rounded-xl bg-[#229ED9]/15 hover:bg-[#229ED9]/25 text-[#229ED9] py-2.5 px-3 text-xs font-bold transition-colors shadow-xs"
                        >
                            <svg class="size-4 shrink-0 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="m20.665 3.717l-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42l10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l-.002.001l-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15l4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"/>
                            </svg>
                            <span>Telegram</span>
                        </a>

                        {{-- Facebook --}}
                        <a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($raffle->publicUrl()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-center gap-2 rounded-xl bg-[#1877F2]/15 hover:bg-[#1877F2]/25 text-[#1877F2] py-2.5 px-3 text-xs font-bold transition-colors shadow-xs"
                        >
                            <svg class="size-4 shrink-0 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669c1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span>Facebook</span>
                        </a>

                        {{-- X (Twitter) --}}
                        <a
                            href="https://twitter.com/intent/tweet?url={{ rawurlencode($raffle->publicUrl()) }}&text={{ rawurlencode('🎟️ '.$raffle->title) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-center gap-2 rounded-xl bg-sunken hover:bg-neutral-200 dark:hover:bg-neutral-800 text-ink py-2.5 px-3 text-xs font-bold transition-colors shadow-xs"
                        >
                            <svg class="size-4 shrink-0 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18.244 2.25h3.308l-7.227 8.26l8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                            <span>X</span>
                        </a>
                    </div>
                </div>

                {{-- Copy full WhatsApp text --}}
                <div class="mt-4 pt-3.5 border-t border-line" x-data="copyable(@js($raffle->toShareText($paymentMethods)))">
                    <button type="button" class="btn btn-secondary w-full text-xs font-bold min-h-10 gap-2 justify-center" x-on:click="copy()">
                        <x-heroicon-o-document-duplicate class="size-4" x-show="! copied" />
                        <x-heroicon-m-check class="text-brand-ink size-4" x-show="copied" x-cloak />
                        <span x-text="copied ? @js(__('¡Mensaje completo copiado!')) : @js(__('Copiar texto completo para WhatsApp'))">{{ __('Copiar texto completo para WhatsApp') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
