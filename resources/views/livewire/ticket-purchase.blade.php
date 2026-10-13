<div x-data="ticketPurchase(@js(['prices' => $prices, 'min' => $minimum, 'max' => $maximum]))">
    <section id="numeros" class="scroll-mt-4" aria-labelledby="board-title">
        <h2 id="board-title" class="section-title">{{ __('Pick your numbers') }}</h2>
        <p class="text-ink-soft mt-1 text-sm text-pretty">{{ __('Tap the ones you want or let luck decide.') }}</p>

        @if ($offers !== [])
            <ul class="mt-4 grid grid-cols-2 gap-2.5" aria-label="{{ __('Offers') }}">
                @foreach ($offers as $offer)
                    <li wire:key="offer-{{ $offer['quantity'] }}">
                        <button
                            type="button"
                            class="card hover:border-line-strong flex size-full cursor-pointer flex-col p-3.5 text-left transition active:scale-[0.98]"
                            wire:click="addRandom({{ $offer['quantity'] }})"
                            wire:loading.attr="disabled"
                            wire:target="addRandom"
                        >
                            <span class="caption">{{ __(':count tickets', ['count' => $offer['quantity']]) }}</span>
                            <span class="mt-0.5 text-xl leading-tight font-extrabold tracking-tight tabular-nums">{{ $offer['price'] }}</span>
                            @if ($offer['saving'])
                                <span class="text-brand-ink text-[0.8125rem] font-bold">{{ __('You save :amount', ['amount' => $offer['saving']]) }}</span>
                            @endif
                            <span class="text-ink-soft mt-2 flex items-center gap-1 text-[0.8125rem] font-semibold">
                                <x-heroicon-m-plus class="size-3.5" />
                                {{ __('Add at random') }}
                            </span>
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-5">
            <p class="caption">{{ __('Add at random') }}</p>
            <div class="mt-2 grid grid-cols-4 gap-2">
                @foreach ([1, 2, 5, 10] as $quantity)
                    <button
                        type="button"
                        class="btn btn-secondary btn-sm px-0 tabular-nums"
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

        <form wire:submit="findNumber" class="mt-3" novalidate>
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

        <div class="card mt-5 p-4">
            @if ($pageCount > 1)
                <nav class="mb-4 flex items-center justify-between gap-2" aria-label="{{ __('Number ranges') }}">
                    <button
                        type="button"
                        class="icon-btn"
                        wire:click="showPage({{ $page - 1 }})"
                        wire:loading.attr="disabled"
                        wire:target="showPage"
                        @disabled($page === 0)
                        aria-label="{{ __('Previous numbers') }}"
                    >
                        <x-heroicon-m-chevron-left class="size-5" />
                    </button>

                    <label class="hover:bg-sunken relative flex min-h-11 cursor-pointer flex-col items-center justify-center rounded-xl px-4 text-center leading-tight transition">
                        <span class="flex items-center gap-1 font-bold tabular-nums">
                            {{ $pageLabel }}
                            <x-heroicon-m-chevron-down class="text-ink-faint size-4" />
                        </span>
                        <span class="text-ink-faint block text-xs font-medium">{{ __('Page :current of :total', ['current' => $page + 1, 'total' => $pageCount]) }}</span>
                        <select
                            class="absolute inset-0 size-full cursor-pointer opacity-0"
                            aria-label="{{ __('Go to a range of numbers') }}"
                            wire:change="showPage($event.target.value)"
                        >
                            @foreach ($pageLabels as $index => $label)
                                <option value="{{ $index }}" @selected($index === $page)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </label>

                    <button
                        type="button"
                        class="icon-btn"
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

            <ul class="text-ink-soft flex flex-wrap items-center gap-x-4 gap-y-1 text-xs font-medium" aria-hidden="true">
                <li class="flex items-center gap-1.5"><span class="bg-sunken border-line size-3.5 rounded border"></span>{{ __('Available') }}</li>
                <li class="flex items-center gap-1.5"><span class="bg-brand size-3.5 rounded"></span>{{ __('Yours') }}</li>
                <li class="flex items-center gap-1.5"><span class="text-ink-faint line-through opacity-60">00</span>{{ __('Taken') }}</li>
            </ul>

            <div
                class="mt-3 grid grid-cols-5 gap-1.5 transition-opacity sm:grid-cols-10"
                wire:key="board-{{ $page }}"
                wire:loading.class="opacity-40"
                wire:target="showPage, findNumber"
                x-ref="board"
                x-on:click="pick($event)"
                x-effect="paint($wire.selected)"
                role="group"
                aria-label="{{ __('Numbers :range', ['range' => $pageLabel]) }}"
            >
                @foreach ($numbers as $tile)
                    @if ($tile['taken'])
                        <button type="button" class="number-tile" disabled aria-label="{{ __(':number, taken', ['number' => $tile['number']]) }}">{{ $tile['number'] }}</button>
                    @else
                        <button type="button" class="number-tile" data-number="{{ $tile['number'] }}" aria-pressed="{{ in_array($tile['number'], $selected, true) ? 'true' : 'false' }}">{{ $tile['number'] }}</button>
                    @endif
                @endforeach
            </div>
        </div>

        <p class="bg-warning-soft text-warning mt-3 rounded-xl px-4 py-2.5 text-sm font-semibold" x-show="limitReached" x-cloak x-transition.opacity role="status">
            {{ __('You reached the limit of :max tickets per purchase.', ['max' => $maximum]) }}
        </p>

        @error('selected')
            <p class="bg-danger-soft text-danger mt-3 rounded-xl px-4 py-2.5 text-sm font-semibold" role="alert">{{ $message }}</p>
        @enderror

        <div class="mt-5" x-show="count > 0" x-cloak>
            <div class="flex items-center justify-between gap-3">
                <h3 class="text-sm font-bold">
                    {{ __('Your numbers') }}
                    <span class="text-ink-faint tabular-nums" x-text="'(' + count + ')'"></span>
                </h3>
                <button type="button" class="text-ink-soft hover:text-ink -mr-2 min-h-9 px-2 text-sm font-semibold" x-on:click="$wire.selected = []">
                    {{ __('Remove all') }}
                </button>
            </div>
            <ul class="mt-2 flex flex-wrap gap-2" wire:ignore>
                <template x-for="number in sortedSelection" x-bind:key="number">
                    <li class="number-chip">
                        <span x-text="number"></span>
                        <button
                            type="button"
                            class="hover:bg-brand/15 flex size-7 cursor-pointer items-center justify-center rounded-full transition"
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

    <div class="border-line bg-surface shadow-bar pb-safe fixed inset-x-0 bottom-0 z-30 border-t">
        <div class="mx-auto flex w-full max-w-xl items-center gap-3 px-4 pt-3">
            <div class="min-w-0 flex-1 leading-tight" aria-live="polite">
                <div x-show="count === 0">
                    <p class="caption">{{ __('From') }}</p>
                    <p class="text-xl font-extrabold tracking-tight tabular-nums">{{ $prices[min(1, count($prices) - 1)] }}</p>
                </div>
                <div x-show="count > 0" x-cloak>
                    <p class="caption truncate">
                        <span x-show="missing === 0">
                            <span class="tabular-nums" x-text="count"></span>
                            <span x-text="count === 1 ? @js(__('ticket')) : @js(__('tickets'))"></span>
                        </span>
                        <span class="text-brand-ink font-bold" x-show="missing > 0" x-text="@js(__('Minimum :count tickets', ['count' => $minimum]))"></span>
                    </p>
                    <p class="text-xl font-extrabold tracking-tight tabular-nums" x-text="total"></p>
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
                <x-heroicon-m-arrow-right class="size-4" wire:loading.remove wire:target="checkout" />
            </button>
        </div>
    </div>

    @if ($step !== 'pick')
        <div
            x-ref="sheet"
            class="bg-canvas animate-sheet-up fixed inset-0 z-40 overflow-y-auto overscroll-contain outline-none"
            tabindex="-1"
            role="dialog"
            aria-modal="true"
            aria-labelledby="sheet-title"
            wire:key="sheet-{{ $step }}"
        >
            @include($step === 'done' ? 'livewire.ticket-purchase.done' : 'livewire.ticket-purchase.checkout')
        </div>
    @endif
</div>
