@php
    $shownNumbers = 15;
    $paymentMethods = $this->paymentMethods;
@endphp

<div class="mx-auto flex min-h-full w-full max-w-xl flex-col px-4">
    <header class="bg-canvas pt-safe sticky top-0 z-10 -mx-4 flex items-center gap-1 px-2 pb-2">
        <button type="button" class="icon-btn" wire:click="backToNumbers" aria-label="{{ __('Back to the numbers') }}">
            <x-heroicon-m-arrow-left class="size-5" />
        </button>
        <h2 id="sheet-title" class="text-lg font-bold">{{ __('Report your payment') }}</h2>
    </header>

    <form x-on:submit.prevent="send()" class="flex flex-1 flex-col" novalidate>
        <div class="flex-1 space-y-6 pt-2 pb-6">
            <section class="card p-5" aria-label="{{ __('Your purchase') }}">
                <div class="flex items-center justify-between gap-3">
                    <h3 class="eyebrow">{{ __('Your numbers') }}</h3>
                    <button type="button" class="text-brand-ink -mr-2 min-h-9 px-2 text-sm font-semibold" wire:click="backToNumbers">{{ __('Change') }}</button>
                </div>
                <ul class="mt-2 flex flex-wrap gap-1.5">
                    @foreach (collect($selected)->sort()->take($shownNumbers) as $number)
                        <li class="bg-brand-soft text-brand-ink rounded-full px-2.5 py-1 text-sm font-bold tabular-nums">{{ $number }}</li>
                    @endforeach
                    @if (count($selected) > $shownNumbers)
                        <li class="bg-sunken text-ink-soft rounded-full px-2.5 py-1 text-sm font-semibold tabular-nums">+{{ count($selected) - $shownNumbers }}</li>
                    @endif
                </ul>
                <dl class="border-line mt-4 flex items-end justify-between gap-3 border-t pt-4">
                    <dt class="text-ink-soft text-sm">{{ trans_choice('{1} :count ticket|[2,*] :count tickets', count($selected), ['count' => count($selected)]) }}</dt>
                    <dd class="text-2xl leading-none font-extrabold tracking-tight tabular-nums">{{ $total }}</dd>
                </dl>
            </section>

            <fieldset>
                <legend class="flex items-center gap-2.5 text-base font-bold">
                    <span class="bg-ink text-canvas flex size-7 items-center justify-center rounded-full text-sm tabular-nums">1</span>
                    {{ __('Make the payment') }}
                </legend>

                @if ($paymentMethods->isEmpty())
                    <p class="bg-warning-soft text-warning mt-3 rounded-2xl px-4 py-3 text-sm font-medium">
                        {{ __('The organizer has not set up payment methods yet.') }}
                    </p>
                @else
                    <div class="mt-3 space-y-2.5" role="radiogroup" aria-label="{{ __('Payment method') }}" @error('paymentMethodId') aria-invalid="true" @enderror>
                        @foreach ($paymentMethods as $method)
                            <label class="border-line bg-surface has-checked:border-brand has-checked:ring-brand/25 has-focus-visible:outline-brand flex cursor-pointer items-center gap-3 rounded-2xl border p-3 transition has-checked:ring-4 has-focus-visible:outline-2" wire:key="method-{{ $method->id }}">
                                <input type="radio" name="payment-method" class="peer sr-only" value="{{ $method->id }}" wire:model.live="paymentMethodId">
                                <span class="bg-sunken flex size-11 shrink-0 items-center justify-center overflow-hidden rounded-xl">
                                    @if ($icon = $method->iconUrl())
                                        <img src="{{ $icon }}" alt="" class="size-full object-cover" width="88" height="88" decoding="async">
                                    @else
                                        <x-heroicon-o-banknotes class="text-ink-soft size-6" />
                                    @endif
                                </span>
                                <span class="min-w-0 flex-1 leading-tight">
                                    <span class="block truncate font-semibold">{{ $method->title }}</span>
                                    <span class="text-ink-faint block text-xs">{{ $method->currency === 'VED' ? __('You pay in bolivars') : __('You pay in dollars') }}</span>
                                </span>
                                <span class="border-line peer-checked:border-brand peer-checked:bg-brand flex size-6 shrink-0 items-center justify-center rounded-full border-2 transition">
                                    <x-heroicon-m-check class="text-on-brand size-4 opacity-0 transition peer-checked:opacity-100" />
                                </span>
                            </label>
                        @endforeach
                    </div>

                    @error('paymentMethodId')
                        <p class="field-error" role="alert">{{ $message }}</p>
                    @enderror

                    @foreach ($paymentMethods as $method)
                        @php($quote = $quotes[$method->id])

                        <div class="card mt-3 overflow-hidden" wire:key="instructions-{{ $method->id }}" x-show="$wire.paymentMethodId == {{ $method->id }}" x-cloak>
                            <div class="bg-brand-soft px-5 py-4 text-center" x-data="copyable(@js($quote['plain']))">
                                <p class="text-brand-ink text-xs font-semibold tracking-wide uppercase">{{ __('Exact amount to send') }}</p>
                                <p class="mt-1 text-3xl font-extrabold tracking-tight tabular-nums">{{ $quote['amount'] }}</p>

                                @if ($quote['converted'])
                                    <p class="text-brand-ink mt-1 text-xs font-medium">{{ __(':total at the BCV rate of :rate', ['total' => $total, 'rate' => $quote['rate']]) }}</p>
                                @elseif ($quote['needs_manual_conversion'])
                                    <p class="text-brand-ink mt-1 text-xs font-medium text-pretty">{{ __('Pay the equivalent in bolivars at the official BCV rate of the day.') }}</p>
                                @endif

                                <button type="button" class="bg-surface text-ink mt-3 inline-flex min-h-9 cursor-pointer items-center gap-1.5 rounded-full px-3.5 text-sm font-semibold transition active:scale-95" x-on:click="copy()">
                                    <x-heroicon-m-clipboard-document class="size-4" x-show="! copied" />
                                    <x-heroicon-m-check class="text-success size-4" x-show="copied" x-cloak />
                                    <span x-text="copied ? @js(__('Copied')) : @js(__('Copy amount'))">{{ __('Copy amount') }}</span>
                                </button>
                            </div>

                            <dl class="divide-line divide-y">
                                @foreach ($method->description ?? [] as $label => $value)
                                    <div class="flex items-center gap-3 py-2.5 pr-2 pl-5" x-data="copyable(@js((string) $value))">
                                        <div class="min-w-0 flex-1 leading-tight">
                                            <dt class="text-ink-faint text-xs">{{ $label }}</dt>
                                            <dd class="font-semibold break-words select-all">{{ $value }}</dd>
                                        </div>
                                        <button type="button" class="icon-btn" x-on:click="copy()" aria-label="{{ __('Copy :field', ['field' => $label]) }}">
                                            <x-heroicon-o-clipboard-document class="size-5" x-show="! copied" />
                                            <x-heroicon-m-check class="text-success size-5" x-show="copied" x-cloak />
                                        </button>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    @endforeach
                @endif
            </fieldset>

            <fieldset>
                <legend class="flex items-center gap-2.5 text-base font-bold">
                    <span class="bg-ink text-canvas flex size-7 items-center justify-center rounded-full text-sm tabular-nums">2</span>
                    {{ __('Tell us who you are') }}
                </legend>

                <div class="mt-3 grid grid-cols-2 gap-3">
                    <div class="col-span-2">
                        <label for="buyer-dni" class="field-label">{{ __('ID number') }}</label>
                        <input id="buyer-dni" type="text" inputmode="numeric" autocomplete="off" class="field tabular-nums" placeholder="12345678" maxlength="12" wire:model.live.blur="dni" @error('dni') aria-invalid="true" aria-describedby="buyer-dni-error" @enderror>
                        @error('dni') <p id="buyer-dni-error" class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="buyer-name" class="field-label">{{ __('First name') }}</label>
                        <input id="buyer-name" type="text" autocomplete="given-name" autocapitalize="words" class="field" maxlength="60" wire:model.live.blur="name" @error('name') aria-invalid="true" aria-describedby="buyer-name-error" @enderror>
                        @error('name') <p id="buyer-name-error" class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="buyer-lastname" class="field-label">{{ __('Last name') }}</label>
                        <input id="buyer-lastname" type="text" autocomplete="family-name" autocapitalize="words" class="field" maxlength="60" wire:model.live.blur="lastname" @error('lastname') aria-invalid="true" aria-describedby="buyer-lastname-error" @enderror>
                        @error('lastname') <p id="buyer-lastname-error" class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="buyer-phone" class="field-label">{{ __('Mobile number') }}</label>
                        <input id="buyer-phone" type="tel" inputmode="tel" autocomplete="tel" class="field tabular-nums" placeholder="0412 1234567" maxlength="20" wire:model.live.blur="phone" aria-describedby="buyer-phone-hint @error('phone') buyer-phone-error @enderror" @error('phone') aria-invalid="true" @enderror>
                        @error('phone')
                            <p id="buyer-phone-error" class="field-error" role="alert">{{ $message }}</p>
                        @enderror
                        <p id="buyer-phone-hint" class="text-ink-faint mt-1.5 text-xs">{{ __('The organizer will call this number if you win. Outside Venezuela, start with + and your country code.') }}</p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend class="flex items-center gap-2.5 text-base font-bold">
                    <span class="bg-ink text-canvas flex size-7 items-center justify-center rounded-full text-sm tabular-nums">3</span>
                    {{ __('Confirm your payment') }}
                </legend>

                <div class="mt-3 space-y-3">
                    <div>
                        <label for="payment-reference" class="field-label">{{ __('Reference number') }}</label>
                        <input id="payment-reference" type="text" autocomplete="off" autocapitalize="characters" spellcheck="false" class="field tabular-nums uppercase placeholder:normal-case" placeholder="{{ __('As shown on your receipt') }}" maxlength="40" wire:model.live.blur="reference" @error('reference') aria-invalid="true" aria-describedby="payment-reference-error" @enderror>
                        @error('reference') <p id="payment-reference-error" class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>

                    <div x-data="proofUpload">
                        <span id="payment-proof-label" class="field-label">{{ __('Payment capture') }}</span>

                        <label
                            class="border-line bg-surface hover:border-brand has-focus-visible:outline-brand flex min-h-28 cursor-pointer flex-col items-center justify-center gap-1.5 rounded-2xl border-2 border-dashed px-4 py-5 text-center transition has-focus-visible:outline-2"
                            x-show="! preview"
                            @error('proof') aria-invalid="true" @enderror
                        >
                            <input type="file" accept="image/*" class="sr-only" x-on:change="pick($event)" aria-labelledby="payment-proof-label">
                            <span class="bg-brand-soft text-brand-ink flex size-11 items-center justify-center rounded-full">
                                <x-heroicon-o-photo class="size-6" />
                            </span>
                            <span class="font-semibold">{{ __('Upload the capture') }}</span>
                            <span class="text-ink-faint text-xs">{{ __('A screenshot from your bank app is enough.') }}</span>
                        </label>

                        <div class="border-line bg-surface flex items-center gap-3 rounded-2xl border p-3" x-show="preview" x-cloak>
                            <img x-bind:src="preview" alt="{{ __('Payment capture') }}" class="bg-sunken size-16 shrink-0 rounded-xl object-cover">
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold" x-show="! proofUploading">{{ __('Capture ready') }}</p>
                                <p class="font-semibold" x-show="proofUploading" x-cloak>{{ __('Uploading…') }}</p>
                                <div class="bg-sunken mt-2 h-1.5 overflow-hidden rounded-full" x-show="proofUploading" x-cloak>
                                    <div class="bg-brand h-full rounded-full transition-all" x-bind:style="'width: ' + progress + '%'"></div>
                                </div>
                                <label class="text-brand-ink mt-1 inline-flex min-h-8 cursor-pointer items-center text-sm font-semibold" x-show="! proofUploading">
                                    <input type="file" accept="image/*" class="sr-only" x-on:change="pick($event)">
                                    {{ __('Change image') }}
                                </label>
                            </div>
                            <button type="button" class="icon-btn" x-on:click="clear()" x-show="! proofUploading" aria-label="{{ __('Remove capture') }}">
                                <x-heroicon-o-trash class="size-5" />
                            </button>
                        </div>

                        <p class="field-error" x-show="failed" x-cloak role="alert">{{ __('The image could not be uploaded. Check your connection and try again.') }}</p>
                        <p class="field-error" x-show="notAnImage" x-cloak role="alert">{{ __('Attach an image of your payment (JPG, PNG or WEBP).') }}</p>
                        @error('proof') <p class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>
                </div>
            </fieldset>

            <p class="text-ink-faint flex items-start gap-2 text-xs text-pretty">
                <x-heroicon-m-lock-closed class="mt-px size-4 shrink-0" />
                {{ __('Your numbers stay reserved while the organizer confirms the payment.') }}
            </p>
        </div>

        <div class="border-line bg-canvas pb-safe sticky bottom-0 -mx-4 border-t px-4 pt-3">
            @error('throttle')
                <p class="bg-danger-soft text-danger mb-3 rounded-2xl px-4 py-2.5 text-sm font-medium" role="alert">{{ $message }}</p>
            @enderror

            @if ($errors->any() && ! $errors->has('throttle'))
                <p class="text-danger mb-2 text-center text-sm font-medium" role="alert">{{ __('Check the highlighted fields.') }}</p>
            @endif

            <button type="submit" class="btn btn-primary w-full" x-bind:disabled="proofUploading" wire:loading.attr="disabled" wire:target="submit" @disabled($paymentMethods->isEmpty())>
                <span wire:loading.remove wire:target="submit">{{ __('Report payment') }}</span>
                <span class="inline-flex items-center gap-2" wire:loading.flex wire:target="submit">
                    <svg class="size-5 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" class="opacity-25" />
                        <path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                    </svg>
                    {{ __('Sending…') }}
                </span>
            </button>
        </div>
    </form>
</div>
