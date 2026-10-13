<div x-data="ticketPurchase(@js(['prices' => $prices, 'min' => $minimum, 'max' => $maximum]))">
    <section id="numeros" class="card scroll-mt-4 p-5" aria-labelledby="board-title">
        <h2 id="board-title" class="text-lg font-bold">{{ __('Pick your numbers') }}</h2>
        <p class="text-ink-soft mt-0.5 text-sm text-pretty">{{ __('Tap the ones you want or let luck decide.') }}</p>

        @if ($offers !== [])
            <ul class="scrollbar-none -mx-5 mt-4 flex snap-x gap-2.5 overflow-x-auto px-5" aria-label="{{ __('Offers') }}">
                @foreach ($offers as $offer)
                    <li class="shrink-0 snap-start" wire:key="offer-{{ $offer['quantity'] }}">
                        <button
                            type="button"
                            class="border-brand/40 bg-brand-soft hover:border-brand flex h-full min-w-36 cursor-pointer flex-col rounded-2xl border px-4 py-3 text-left transition active:scale-[0.98]"
                            wire:click="addRandom({{ $offer['quantity'] }})"
                            wire:loading.attr="disabled"
                            wire:target="addRandom"
                        >
                            <span class="text-brand-ink text-xs font-semibold">{{ __(':count tickets', ['count' => $offer['quantity']]) }}</span>
                            <span class="mt-0.5 text-lg leading-tight font-extrabold tabular-nums">{{ $offer['price'] }}</span>
                            @if ($offer['saving'])
                                <span class="text-brand-ink mt-0.5 text-xs font-medium">{{ __('You save :amount', ['amount' => $offer['saving']]) }}</span>
                            @endif
                            <span class="text-ink-soft mt-2 flex items-center gap-1 text-xs font-semibold">
                                <x-heroicon-m-plus class="size-3.5" />
                                {{ __('Add at random') }}
                            </span>
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-5">
            <p class="text-ink-faint flex items-center gap-1.5 text-xs font-medium">
                <x-heroicon-m-sparkles class="size-4" />
                {{ __('Add at random') }}
            </p>
            <div class="mt-2 grid grid-cols-4 gap-2">
                @foreach ([1, 2, 5, 10] as $quantity)
                    <button
                        type="button"
                        class="btn btn-secondary min-h-11 px-0 text-sm tabular-nums"
                        wire:click="addRandom({{ $quantity }})"
                        wire:loading.attr="disabled"
                        wire:target="addRandom"
                        aria-label="{{ trans_choice('{1} Add :count random number|[2,*] Add :count random numbers', $quantity, ['count' => $quantity]) }}"
                    >
                        +{{ $quantity }}
                    </button>
                @endforeach
            </div>
        </div>

        <form wire:submit="findNumber" class="mt-4" novalidate>
            <label for="number-search" class="sr-only">{{ __('Search a number') }}</label>
            <div class="flex gap-2">
                <div class="relative min-w-0 flex-1">
                    <x-heroicon-m-magnifying-glass class="text-ink-faint pointer-events-none absolute top-1/2 left-3.5 size-5 -translate-y-1/2" />
                    <input
                        id="number-search"
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        autocomplete="off"
                        enterkeyhint="search"
                        maxlength="{{ $raffle->numberLength() }}"
                        class="field pl-11 tabular-nums"
                        placeholder="{{ __('Search a number') }}"
                        wire:model="search"
                        @error('search') aria-invalid="true" aria-describedby="number-search-error" @enderror
                    >
                </div>
                <button type="submit" class="btn btn-secondary shrink-0 px-4" wire:loading.attr="disabled" wire:target="findNumber">
                    {{ __('Add') }}
                </button>
            </div>
            @error('search')
                <p id="number-search-error" class="field-error" role="alert">{{ $message }}</p>
            @enderror
        </form>

        @if ($pageCount > 1)
            <nav class="mt-5 flex items-center justify-between gap-2" aria-label="{{ __('Number ranges') }}">
                <button
                    type="button"
                    class="icon-btn border-line border"
                    wire:click="showPage({{ $page - 1 }})"
                    wire:loading.attr="disabled"
                    wire:target="showPage"
                    @disabled($page === 0)
                    aria-label="{{ __('Previous numbers') }}"
                >
                    <x-heroicon-m-chevron-left class="size-5" />
                </button>
                <p class="text-center leading-tight" aria-live="polite">
                    <span class="block font-bold tabular-nums">{{ $pageLabel }}</span>
                    <span class="text-ink-faint block text-xs">{{ __('Page :current of :total', ['current' => $page + 1, 'total' => $pageCount]) }}</span>
                </p>
                <button
                    type="button"
                    class="icon-btn border-line border"
                    wire:click="showPage({{ $page + 1 }})"
                    wire:loading.attr="disabled"
                    wire:target="showPage"
                    @disabled($page >= $pageCount - 1)
                    aria-label="{{ __('Next numbers') }}"
                >
                    <x-heroicon-m-chevron-right class="size-5" />
                </button>
            </nav>
        @endif

        <ul class="text-ink-soft mt-5 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs" aria-hidden="true">
            <li class="flex items-center gap-1.5"><span class="bg-sunken size-3.5 rounded-md"></span>{{ __('Available') }}</li>
            <li class="flex items-center gap-1.5"><span class="bg-brand size-3.5 rounded-md"></span>{{ __('Yours') }}</li>
            <li class="flex items-center gap-1.5"><span class="border-line size-3.5 rounded-md border border-dashed"></span>{{ __('Taken') }}</li>
        </ul>

        <div
            class="mt-3 grid grid-cols-5 gap-2 transition-opacity sm:grid-cols-10"
            wire:loading.class="opacity-40"
            wire:target="showPage, findNumber"
            role="group"
            aria-label="{{ __('Numbers :range', ['range' => $pageLabel]) }}"
        >
            @foreach ($numbers as $tile)
                @if ($tile['taken'])
                    <button type="button" class="number-tile" wire:key="number-{{ $tile['number'] }}" disabled aria-label="{{ __(':number, taken', ['number' => $tile['number']]) }}">
                        {{ $tile['number'] }}
                    </button>
                @else
                    <button
                        type="button"
                        class="number-tile"
                        wire:key="number-{{ $tile['number'] }}"
                        x-on:click="toggle('{{ $tile['number'] }}')"
                        x-bind:aria-pressed="has('{{ $tile['number'] }}')"
                        aria-pressed="false"
                    >
                        {{ $tile['number'] }}
                    </button>
                @endif
            @endforeach
        </div>

        <p class="bg-warning-soft text-warning mt-3 rounded-2xl px-4 py-2.5 text-sm font-medium" x-show="limitReached" x-cloak x-transition.opacity role="status">
            {{ __('You reached the limit of :max tickets per purchase.', ['max' => $maximum]) }}
        </p>

        @error('selected')
            <p class="bg-danger-soft text-danger mt-3 rounded-2xl px-4 py-2.5 text-sm font-medium" role="alert">{{ $message }}</p>
        @enderror

        <div class="border-line mt-5 border-t pt-4" x-show="count > 0" x-cloak>
            <div class="flex items-center justify-between gap-3">
                <h3 class="text-sm font-semibold">
                    {{ __('Your numbers') }}
                    <span class="text-ink-faint tabular-nums" x-text="'(' + count + ')'"></span>
                </h3>
                <button type="button" class="text-ink-soft hover:text-ink -mr-2 min-h-9 px-2 text-sm font-medium" x-on:click="$wire.selected = []">
                    {{ __('Remove all') }}
                </button>
            </div>
            <ul class="mt-2 flex flex-wrap gap-2" wire:ignore>
                <template x-for="number in sortedSelection" x-bind:key="number">
                    <li class="number-chip">
                        <span x-text="number"></span>
                        <button
                            type="button"
                            class="hover:bg-brand/20 flex size-6 cursor-pointer items-center justify-center rounded-full transition"
                            x-on:click="remove(number)"
                            x-bind:aria-label="@js(__('Remove number')) + ' ' + number"
                        >
                            <x-heroicon-m-x-mark class="size-4" />
                        </button>
                    </li>
                </template>
            </ul>
        </div>
    </section>

    <div class="border-line bg-surface/95 shadow-bar pb-safe fixed inset-x-0 bottom-0 z-30 border-t backdrop-blur-md">
        <div class="mx-auto flex w-full max-w-xl items-center gap-3 px-4 pt-3">
            <div class="min-w-0 flex-1 leading-tight" aria-live="polite">
                <div x-show="count === 0">
                    <p class="text-ink-faint text-xs">{{ __('From') }}</p>
                    <p class="text-lg font-extrabold tabular-nums">{{ $prices[min(1, count($prices) - 1)] }}</p>
                </div>
                <div x-show="count > 0" x-cloak>
                    <p class="text-ink-faint truncate text-xs">
                        <span x-show="missing === 0">
                            <span class="tabular-nums" x-text="count"></span>
                            <span x-text="count === 1 ? @js(__('ticket')) : @js(__('tickets'))"></span>
                        </span>
                        <span class="text-brand-ink font-semibold" x-show="missing > 0" x-text="@js(__('Minimum :count tickets', ['count' => $minimum]))"></span>
                    </p>
                    <p class="text-lg font-extrabold tabular-nums" x-text="total"></p>
                </div>
            </div>

            <button type="button" class="btn btn-primary shrink-0" x-show="count === 0" x-on:click="scrollToBoard()">
                {{ __('Pick numbers') }}
            </button>
            <button
                type="button"
                class="btn btn-primary shrink-0"
                x-show="count > 0"
                x-cloak
                x-bind:disabled="! canContinue"
                wire:click="checkout"
                wire:loading.attr="disabled"
                wire:target="checkout"
            >
                <span wire:loading.remove wire:target="checkout">{{ __('Continue') }}</span>
                <span wire:loading wire:target="checkout">{{ __('One moment…') }}</span>
                <x-heroicon-m-arrow-right class="size-5" wire:loading.remove wire:target="checkout" />
            </button>
        </div>
    </div>

    @if ($step !== 'pick')
        <div
            x-ref="sheet"
            class="bg-canvas animate-sheet-up fixed inset-0 z-40 overflow-y-auto overscroll-contain"
            role="dialog"
            aria-modal="true"
            aria-labelledby="sheet-title"
            wire:key="sheet-{{ $step }}"
        >
            @include($step === 'done' ? 'livewire.ticket-purchase.done' : 'livewire.ticket-purchase.checkout')
        </div>
    @endif
</div>
