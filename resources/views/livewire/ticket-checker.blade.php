<div x-data="sheet('checker')">
    <section class="card flex items-center gap-3.5 p-5" aria-labelledby="checker-title">
        <span class="bg-sunken text-ink-soft flex size-11 shrink-0 items-center justify-center rounded-full">
            <x-heroicon-o-ticket class="size-5" />
        </span>
        <div class="min-w-0 flex-1 leading-tight">
            <h2 id="checker-title" class="font-bold">{{ __('Already bought?') }}</h2>
            <p class="text-ink-soft mt-0.5 text-sm">{{ __('Look up your tickets with your ID.') }}</p>
        </div>
        <button type="button" class="btn btn-secondary min-h-11 shrink-0 px-4 text-sm" x-on:click="open = true">
            {{ __('Check') }}
        </button>
    </section>

    <div
        class="bg-canvas animate-sheet-up fixed inset-0 z-50 overflow-y-auto overscroll-contain"
        role="dialog"
        aria-modal="true"
        aria-labelledby="checker-sheet-title"
        x-show="open"
        x-cloak
        x-on:keydown.escape.window="open = false"
    >
        <div class="mx-auto w-full max-w-xl px-4 pb-10">
            <header class="bg-canvas/95 pt-safe sticky top-0 z-10 -mx-4 flex items-center gap-1 px-2 pb-2 backdrop-blur-md">
                <button type="button" class="icon-btn" x-on:click="open = false" aria-label="{{ __('Close') }}">
                    <x-heroicon-m-arrow-left class="size-5" />
                </button>
                <h2 id="checker-sheet-title" class="text-lg font-bold">{{ __('Your tickets') }}</h2>
            </header>

            <form wire:submit="check" class="card mt-2 p-5" novalidate>
                <label for="checker-dni" class="field-label">{{ __('ID number') }}</label>
                <div class="flex gap-2">
                    <input
                        id="checker-dni"
                        x-ref="focus"
                        type="text"
                        inputmode="numeric"
                        autocomplete="off"
                        enterkeyhint="search"
                        maxlength="12"
                        class="field min-w-0 flex-1 tabular-nums"
                        placeholder="12345678"
                        wire:model="dni"
                        @error('dni') aria-invalid="true" aria-describedby="checker-dni-error" @enderror
                    >
                    <button type="submit" class="btn btn-primary shrink-0 px-4" wire:loading.attr="disabled" wire:target="check">
                        <span wire:loading.remove wire:target="check">{{ __('Check') }}</span>
                        <span wire:loading wire:target="check">{{ __('Searching…') }}</span>
                    </button>
                </div>
                @error('dni')
                    <p id="checker-dni-error" class="field-error" role="alert">{{ $message }}</p>
                @enderror
                <p class="text-ink-faint mt-2 text-xs">{{ __('Use the same ID you gave when you reported the payment.') }}</p>
            </form>

            <div class="mt-4 space-y-3" aria-live="polite" wire:loading.class="opacity-50" wire:target="check">
                @if ($result !== null)
                    @foreach ($result['rejected'] as $reference)
                        <div class="bg-danger-soft text-danger flex items-start gap-3 rounded-3xl p-4" wire:key="rejected-{{ $loop->index }}">
                            <x-heroicon-o-exclamation-triangle class="mt-0.5 size-5 shrink-0" />
                            <div class="text-sm leading-snug">
                                <p class="font-semibold">{{ __('The organizer rejected a payment you reported.') }}</p>
                                <p class="mt-0.5">{{ __('Reference :reference. Its numbers were released, contact the organizer if this is a mistake.', ['reference' => $reference]) }}</p>
                            </div>
                        </div>
                    @endforeach

                    @if ($result['tickets'] === [])
                        <div class="card flex flex-col items-center px-6 py-9 text-center">
                            <span class="bg-sunken text-ink-soft flex size-12 items-center justify-center rounded-full">
                                <x-heroicon-o-magnifying-glass class="size-6" />
                            </span>
                            <p class="mt-3 font-semibold text-pretty">{{ __('We found no tickets for this ID in this raffle.') }}</p>
                            <p class="text-ink-soft mt-1 text-sm text-pretty">{{ __('Check the number and try again.') }}</p>
                        </div>
                    @else
                        <section class="card p-5">
                            <div class="flex items-baseline justify-between gap-3">
                                <h3 class="font-bold">{{ $result['name'] }}</h3>
                                <p class="text-ink-faint text-sm tabular-nums">{{ trans_choice('{1} :count ticket|[2,*] :count tickets', count($result['tickets']), ['count' => count($result['tickets'])]) }}</p>
                            </div>
                            <ul class="divide-line mt-2 divide-y">
                                @foreach ($result['tickets'] as $ticket)
                                    <li class="flex items-center justify-between gap-3 py-3 last:pb-0" wire:key="ticket-{{ $ticket['number'] }}">
                                        <span class="text-xl font-extrabold tracking-tight tabular-nums">{{ $ticket['number'] }}</span>
                                        @if ($ticket['confirmed'])
                                            <span class="status-pill bg-success-soft text-success">
                                                <x-heroicon-m-check-circle class="size-4" />
                                                {{ __('Confirmed') }}
                                            </span>
                                        @else
                                            <span class="status-pill bg-warning-soft text-warning">
                                                <x-heroicon-m-clock class="size-4" />
                                                {{ __('Awaiting confirmation') }}
                                            </span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
