<x-layouts.public
    :title="$team->name"
    :description="__('Raffles by :organizer. Pick your numbers and report your payment in minutes.', ['organizer' => $team->name])"
    :image="$onSale->first()?->imageUrl()"
    :url="route('raffles.index', $team)"
>
    <div class="mx-auto w-full max-w-xl px-4 pt-8 pb-12 sm:pt-12">
        <header class="flex items-center gap-4">
            <span class="bg-ink text-canvas flex size-14 shrink-0 items-center justify-center rounded-full text-xl font-extrabold uppercase" aria-hidden="true">
                {{ mb_substr($team->name, 0, 1) }}
            </span>
            <div class="min-w-0">
                <h1 class="text-2xl leading-tight font-extrabold tracking-tight text-balance">{{ $team->name }}</h1>
                <p class="text-ink-faint mt-0.5 text-sm font-medium">
                    {{ trans_choice('{0} No raffles on sale|{1} :count raffle on sale|[2,*] :count raffles on sale', $onSale->count(), ['count' => $onSale->count()]) }}
                </p>
            </div>
        </header>

        <main class="mt-8">
            @if ($onSale->isEmpty())
                <div class="card flex flex-col items-center px-6 py-10 text-center">
                    <span class="bg-sunken text-ink-soft flex size-12 items-center justify-center rounded-full">
                        <x-heroicon-o-ticket class="size-6" />
                    </span>
                    <h2 class="section-title mt-4">{{ __('No raffles on sale right now') }}</h2>
                    <p class="text-ink-soft mt-1 text-sm text-pretty">{{ __('Come back soon, a new one may be on the way.') }}</p>
                </div>
            @else
                <h2 class="sr-only">{{ __('On sale') }}</h2>
                <ul class="space-y-5">
                    @foreach ($onSale as $raffle)
                        <li>
                            <a href="{{ $raffle->publicUrl() }}" class="card hover:border-line-strong block overflow-hidden transition active:scale-[0.99]">
                                <div class="bg-sunken relative aspect-[16/10]">
                                    <x-public.raffle-cover :raffle="$raffle" :eager="$loop->first" />
                                    <x-public.status-pill :status="$raffle->salesStatus()" solid class="absolute top-3 left-3" />
                                </div>
                                <div class="p-5">
                                    <h3 class="text-xl leading-snug font-extrabold tracking-tight text-balance">{{ $raffle->title }}</h3>
                                    <p class="text-ink-soft mt-1.5 flex items-center gap-1.5 text-sm">
                                        <x-heroicon-o-calendar-days class="size-4 shrink-0" />
                                        <span class="first-letter:uppercase">{{ $raffle->date->isoFormat('dddd D [de] MMMM, h:mm a') }}</span>
                                    </p>

                                    <div class="mt-4">
                                        <x-public.progress :percentage="$raffle->soldPercentage()" />
                                        <p class="text-ink-faint mt-2 text-xs font-semibold">{{ __(':percentage% sold', ['percentage' => $raffle->soldPercentage()]) }}</p>
                                    </div>

                                    <div class="border-line mt-4 flex items-center justify-between gap-3 border-t pt-4">
                                        <p class="leading-tight">
                                            <span class="caption block">{{ __('Ticket') }}</span>
                                            <span class="mt-0.5 block text-xl font-extrabold tracking-tight tabular-nums">{{ money($raffle->ticket_price, $raffle->currency)->format() }}</span>
                                        </p>
                                        <span class="btn btn-primary btn-sm">
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
                <h2 class="section-title mt-10 mb-3">{{ __('Previous raffles') }}</h2>
                <ul class="card divide-line divide-y overflow-hidden">
                    @foreach ($past as $raffle)
                        <li>
                            <a href="{{ $raffle->publicUrl() }}" class="hover:bg-sunken flex items-center gap-3 p-3.5 transition">
                                <span class="bg-sunken size-12 shrink-0 overflow-hidden rounded-xl">
                                    <x-public.raffle-cover :raffle="$raffle" />
                                </span>
                                <span class="min-w-0 flex-1 leading-tight">
                                    <span class="line-clamp-2 text-[0.9375rem] font-bold text-balance">{{ $raffle->title }}</span>
                                    <span class="text-ink-faint mt-0.5 block text-xs first-letter:uppercase">{{ $raffle->date->isoFormat('D [de] MMMM [de] YYYY') }}</span>
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
