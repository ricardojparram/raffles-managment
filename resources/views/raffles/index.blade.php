<x-layouts.public
    :title="$team->name"
    :description="__('Raffles by :organizer. Pick your numbers and report your payment in minutes.', ['organizer' => $team->name])"
    :image="$onSale->first()?->imageUrl()"
    :url="route('raffles.index', $team)"
>
    <div class="mx-auto w-full max-w-xl px-4 pt-4 pb-12 sm:pt-8">
        <header class="flex flex-col items-center text-center">
            <span class="bg-ink text-canvas flex size-16 items-center justify-center rounded-full text-2xl font-bold uppercase" aria-hidden="true">
                {{ mb_substr($team->name, 0, 1) }}
            </span>
            <h1 class="mt-3 text-2xl font-extrabold tracking-tight text-balance">{{ $team->name }}</h1>
            <p class="text-ink-soft mt-1 text-sm">
                {{ trans_choice('{0} No raffles on sale|{1} :count raffle on sale|[2,*] :count raffles on sale', $onSale->count(), ['count' => $onSale->count()]) }}
            </p>
        </header>

        <main class="mt-8">
            @if ($onSale->isEmpty())
                <div class="card flex flex-col items-center px-6 py-10 text-center">
                    <span class="bg-sunken text-ink-soft flex size-14 items-center justify-center rounded-full">
                        <x-heroicon-o-ticket class="size-7" />
                    </span>
                    <h2 class="mt-4 text-lg font-bold">{{ __('No raffles on sale right now') }}</h2>
                    <p class="text-ink-soft mt-1 text-sm text-pretty">{{ __('Come back soon, a new one may be on the way.') }}</p>
                </div>
            @else
                <h2 class="sr-only">{{ __('On sale') }}</h2>
                <ul class="space-y-4">
                    @foreach ($onSale as $raffle)
                        <li>
                            <a href="{{ $raffle->publicUrl() }}" class="card group block overflow-hidden transition active:scale-[0.99]">
                                <div class="bg-sunken relative aspect-[16/10]">
                                    <x-public.raffle-cover :raffle="$raffle" :eager="$loop->first" />
                                    <x-public.status-pill :status="$raffle->salesStatus()" class="absolute top-3 left-3 shadow-sm" />
                                </div>
                                <div class="p-5">
                                    <h3 class="text-xl leading-snug font-extrabold tracking-tight text-balance">{{ $raffle->title }}</h3>
                                    <p class="text-ink-soft mt-1.5 flex items-center gap-1.5 text-sm">
                                        <x-heroicon-m-calendar-days class="size-4 shrink-0" />
                                        <span class="first-letter:uppercase">{{ $raffle->date->isoFormat('dddd D [de] MMMM, h:mm a') }}</span>
                                    </p>

                                    <div class="mt-4">
                                        <div class="bg-sunken h-2 overflow-hidden rounded-full">
                                            <div class="bg-brand h-full rounded-full" style="width: {{ max(2, $raffle->soldPercentage()) }}%"></div>
                                        </div>
                                        <p class="text-ink-faint mt-1.5 text-xs font-medium">{{ __(':percentage% sold', ['percentage' => $raffle->soldPercentage()]) }}</p>
                                    </div>

                                    <div class="mt-4 flex items-center justify-between gap-3">
                                        <p class="leading-tight">
                                            <span class="text-ink-faint block text-xs">{{ __('Ticket') }}</span>
                                            <span class="text-lg font-bold tabular-nums">{{ money($raffle->ticket_price, $raffle->currency)->format() }}</span>
                                        </p>
                                        <span class="btn btn-primary min-h-11 px-4 text-sm">
                                            {{ __('Pick numbers') }}
                                            <x-heroicon-m-arrow-right class="size-4" />
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if ($past->isNotEmpty())
                <h2 class="eyebrow mt-10 mb-3 px-1">{{ __('Previous raffles') }}</h2>
                <ul class="card divide-line divide-y overflow-hidden">
                    @foreach ($past as $raffle)
                        <li>
                            <a href="{{ $raffle->publicUrl() }}" class="hover:bg-sunken flex items-center gap-3 p-3 transition">
                                <span class="bg-sunken size-14 shrink-0 overflow-hidden rounded-2xl">
                                    <x-public.raffle-cover :raffle="$raffle" />
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="block truncate font-semibold">{{ $raffle->title }}</span>
                                    <span class="text-ink-faint block text-xs first-letter:uppercase">{{ $raffle->date->isoFormat('D [de] MMMM [de] YYYY') }}</span>
                                </span>
                                <x-public.status-pill :status="$raffle->salesStatus()" class="shrink-0" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </main>

        <x-public.footer :team="$team" />
    </div>
</x-layouts.public>
