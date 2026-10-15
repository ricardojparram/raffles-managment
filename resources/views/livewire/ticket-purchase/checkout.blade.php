@php
    $shownNumbers = 15;
    $paymentMethods = $this->paymentMethods;
@endphp

<div class="mx-auto flex min-h-full w-full max-w-xl flex-col px-4">
    <header class="bg-canvas pt-safe sticky top-0 z-10 -mx-4 flex items-center gap-1 px-2 pb-2">
        <button type="button" class="icon-btn-flat" wire:click="backToNumbers" aria-label="{{ __('Back to the numbers') }}">
            <x-heroicon-m-arrow-left class="size-5" />
        </button>
        <h2 id="sheet-title" class="section-title">{{ __('Report your payment') }}</h2>
    </header>

    <form x-on:submit.prevent="send()" class="flex flex-1 flex-col" novalidate>
        <div class="flex-1 space-y-8 pt-2 pb-7">
            <section class="card p-5" aria-label="{{ __('Your purchase') }}">
                <div class="flex items-center justify-between gap-3">
                    <h3 class="caption">{{ __('Your numbers') }}</h3>
                    <button type="button" class="text-brand-ink -my-2 -mr-2 min-h-9 px-2 text-sm font-bold" wire:click="backToNumbers">{{ __('Change') }}</button>
                </div>
                <ul class="mt-2 flex flex-wrap gap-1.5">
                    @foreach (collect($selected)->sort()->take($shownNumbers) as $number)
                        <li class="bg-sunken rounded-lg px-2.5 py-1 text-sm font-bold tabular-nums">{{ $number }}</li>
                    @endforeach
                    @if (count($selected) > $shownNumbers)
                        <li class="text-ink-faint px-1 py-1 text-sm font-semibold tabular-nums">+{{ count($selected) - $shownNumbers }}</li>
                    @endif
                </ul>
                <dl class="border-line mt-4 flex items-end justify-between gap-3 border-t pt-4">
                    <dt class="text-ink-soft text-sm">{{ trans_choice('{1} :count ticket|[2,*] :count tickets', count($selected), ['count' => count($selected)]) }}</dt>
                    <dd class="text-2xl leading-none font-extrabold tracking-tight tabular-nums">{{ $total }}</dd>
                </dl>
            </section>

            <fieldset>
                <x-public.step number="1">{{ __('Make the payment') }}</x-public.step>

                @if ($paymentMethods->isEmpty())
                    <p class="bg-warning-soft text-warning mt-3 rounded-xl px-4 py-3 text-sm font-semibold">
                        {{ __('The organizer has not set up payment methods yet.') }}
                    </p>
                @else
                    <div class="mt-3 space-y-2" role="radiogroup" aria-label="{{ __('Payment method') }}" @error('paymentMethodId') aria-invalid="true" @enderror>
                        @foreach ($paymentMethods as $method)
                            <label class="border-line has-checked:border-brand has-checked:bg-brand-soft has-focus-visible:outline-brand flex cursor-pointer items-center gap-3 rounded-xl border p-3 transition has-focus-visible:outline-2" wire:key="method-{{ $method->id }}">
                                <input type="radio" name="payment-method" class="peer sr-only" value="{{ $method->id }}" wire:model="paymentMethodId" x-on:change="$wire.$commit()">
                                <x-public.payment-icon :method="$method" class="size-10 rounded-lg shrink-0" />
                                <span class="min-w-0 flex-1 leading-tight">
                                    <span class="block truncate font-bold">{{ $method->title }}</span>
                                    <span class="text-ink-faint block text-[0.8125rem]">{{ $method->currency === 'VED' ? __('You pay in bolivars') : __('You pay in dollars') }}</span>
                                </span>
                                <span class="border-line-strong peer-checked:border-brand peer-checked:bg-brand text-on-brand flex size-5 shrink-0 items-center justify-center rounded-full border transition peer-checked:[&>svg]:opacity-100">
                                    <x-heroicon-m-check class="size-3.5 opacity-0 transition" />
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
                            <div class="bg-sunken px-5 py-5 text-center" x-data="copyable(@js($quote['plain']))">
                                <p class="caption">{{ __('Exact amount to send') }}</p>
                                <p class="mt-1 text-[2rem] leading-none font-extrabold tracking-tight tabular-nums">{{ $quote['amount'] }}</p>

                                @if ($quote['converted'])
                                    <p class="text-ink-soft mt-2 text-[0.8125rem] font-medium">{{ __(':total at the BCV rate of :rate', ['total' => $total, 'rate' => $quote['rate']]) }}</p>
                                @elseif ($quote['needs_manual_conversion'])
                                    <p class="text-ink-soft mt-2 text-[0.8125rem] font-medium text-pretty">{{ __('Pay the equivalent in bolivars at the official BCV rate of the day.') }}</p>
                                @endif

                                <button type="button" class="btn btn-secondary btn-sm mt-3.5 min-h-9 gap-1.5 px-3.5" x-on:click="copy()">
                                    <x-heroicon-o-clipboard-document class="size-4" x-show="! copied" />
                                    <x-heroicon-m-check class="text-brand-ink size-4" x-show="copied" x-cloak />
                                    <span x-text="copied ? @js(__('Copied')) : @js(__('Copy amount'))">{{ __('Copy amount') }}</span>
                                </button>
                            </div>

                            <dl class="divide-line border-line divide-y border-t">
                                @foreach ($method->description ?? [] as $label => $value)
                                    <div class="flex items-center gap-3 py-2 pr-2 pl-5" x-data="copyable(@js((string) $value))">
                                        <div class="min-w-0 flex-1 leading-tight">
                                            <dt class="caption">{{ $label }}</dt>
                                            <dd class="mt-0.5 font-bold break-words select-all">{{ $value }}</dd>
                                        </div>
                                        <button type="button" class="icon-btn-flat" x-on:click="copy()" aria-label="{{ __('Copy :field', ['field' => $label]) }}">
                                            <x-heroicon-o-clipboard-document class="size-5" x-show="! copied" />
                                            <x-heroicon-m-check class="text-brand-ink size-5" x-show="copied" x-cloak />
                                        </button>
                                    </div>
                                @endforeach
                            </dl>

                            <div class="border-line border-t p-3 bg-sunken/40" x-data="copyable(@js($method->clipboardPayload($quote['amount'])))">
                                <button type="button" class="btn btn-primary w-full min-h-11 gap-2 text-sm font-bold shadow-sm" x-on:click="copy()">
                                    <x-heroicon-o-document-duplicate class="size-5" x-show="! copied" />
                                    <x-heroicon-m-check class="text-on-brand size-5" x-show="copied" x-cloak />
                                    <span x-text="copied ? @js(__('¡Datos copiados!')) : @js(__('Copiar todos los datos'))">{{ __('Copiar todos los datos') }}</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </fieldset>

            <fieldset>
                <x-public.step number="2">{{ __('Tell us who you are') }}</x-public.step>

                <div class="mt-3 grid grid-cols-2 gap-x-3 gap-y-4">
                    <div class="col-span-2">
                        <label for="buyer-dni" class="field-label">{{ __('ID number') }}</label>
                        <input id="buyer-dni" type="text" inputmode="numeric" autocomplete="off" class="field tabular-nums" placeholder="12345678" maxlength="12" wire:model="dni" x-on:input="$el.value = $el.value.replace(/\D/g, '').slice(0, 9); $wire.set('dni', $el.value, false)" x-on:keydown="if (!/[0-9]/.test($event.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Enter'].includes($event.key) && !$event.ctrlKey && !$event.metaKey) $event.preventDefault()" x-on:change="$wire.$commit()" @error('dni') aria-invalid="true" aria-describedby="buyer-dni-error" @enderror>
                        @error('dni') <p id="buyer-dni-error" class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="buyer-name" class="field-label">{{ __('First name') }}</label>
                        <input id="buyer-name" type="text" autocomplete="given-name" autocapitalize="words" class="field" maxlength="60" wire:model="name" x-on:change="$wire.$commit()" @error('name') aria-invalid="true" aria-describedby="buyer-name-error" @enderror>
                        @error('name') <p id="buyer-name-error" class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="buyer-lastname" class="field-label">{{ __('Last name') }}</label>
                        <input id="buyer-lastname" type="text" autocomplete="family-name" autocapitalize="words" class="field" maxlength="60" wire:model="lastname" x-on:change="$wire.$commit()" @error('lastname') aria-invalid="true" aria-describedby="buyer-lastname-error" @enderror>
                        @error('lastname') <p id="buyer-lastname-error" class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="buyer-phone" class="field-label">{{ __('Mobile number') }}</label>
                        <input id="buyer-phone" type="tel" inputmode="tel" autocomplete="tel" class="field tabular-nums" placeholder="0412 1234567" maxlength="20" wire:model="phone" x-on:input="$el.value = $el.value.replace(/[^0-9+\s-]/g, '').slice(0, 20); $wire.set('phone', $el.value, false)" x-on:keydown="if (!/[0-9+\s-]/.test($event.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Enter'].includes($event.key) && !$event.ctrlKey && !$event.metaKey) $event.preventDefault()" x-on:change="$wire.$commit()" aria-describedby="buyer-phone-hint @error('phone') buyer-phone-error @enderror" @error('phone') aria-invalid="true" @enderror>
                        @error('phone')
                            <p id="buyer-phone-error" class="field-error" role="alert">{{ $message }}</p>
                        @enderror
                        <p id="buyer-phone-hint" class="text-ink-faint mt-1.5 text-xs">{{ __('The organizer will call this number if you win. Outside Venezuela, start with + and your country code.') }}</p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <x-public.step number="3">{{ __('Confirm your payment') }}</x-public.step>

                <div class="mt-3 space-y-4">
                    <div>
                        <label for="payment-reference" class="field-label">{{ __('Reference number') }}</label>
                        <input id="payment-reference" type="text" autocomplete="off" autocapitalize="characters" spellcheck="false" class="field tabular-nums uppercase placeholder:normal-case" placeholder="{{ __('As shown on your receipt') }}" maxlength="40" wire:model="reference" x-on:input="$el.value = $el.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 40); $wire.set('reference', $el.value, false)" x-on:keydown="if (!/[a-zA-Z0-9]/.test($event.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Enter'].includes($event.key) && !$event.ctrlKey && !$event.metaKey) $event.preventDefault()" x-on:change="$wire.$commit()" @error('reference') aria-invalid="true" aria-describedby="payment-reference-error" @enderror>
                        @error('reference') <p id="payment-reference-error" class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>

                    <div x-data="proofUpload">
                        <span id="payment-proof-label" class="field-label">{{ __('Payment capture') }}</span>

                        <label
                            class="border-line-strong hover:border-brand has-focus-visible:outline-brand aria-invalid:border-danger flex min-h-28 cursor-pointer flex-col items-center justify-center gap-1 rounded-xl border border-dashed px-4 py-5 text-center transition has-focus-visible:outline-2"
                            x-show="! preview"
                            @error('proof') aria-invalid="true" @enderror
                        >
                            <input type="file" accept="image/*" class="sr-only" x-on:change="pick($event)" aria-labelledby="payment-proof-label">
                            <x-heroicon-o-arrow-up-tray class="text-ink-soft size-6" />
                            <span class="mt-1 text-[0.9375rem] font-bold">{{ __('Upload the capture') }}</span>
                            <span class="text-ink-faint text-xs">{{ __('A screenshot from your bank app is enough.') }}</span>
                        </label>

                        <div class="card flex items-center gap-3 p-3" x-show="preview" x-cloak>
                            <img x-bind:src="preview" alt="{{ __('Payment capture') }}" class="bg-sunken size-14 shrink-0 rounded-lg object-cover">
                            <div class="min-w-0 flex-1 leading-tight">
                                <p class="text-[0.9375rem] font-bold" x-show="! proofUploading">{{ __('Capture ready') }}</p>
                                <p class="text-[0.9375rem] font-bold" x-show="proofUploading" x-cloak>{{ __('Uploading…') }}</p>
                                <div class="meter mt-2" x-show="proofUploading" x-cloak>
                                    <div class="transition-all" x-bind:style="'width: ' + progress + '%'"></div>
                                </div>
                                <label class="text-brand-ink inline-flex min-h-8 cursor-pointer items-center text-sm font-bold" x-show="! proofUploading">
                                    <input type="file" accept="image/*" class="sr-only" x-on:change="pick($event)">
                                    {{ __('Change image') }}
                                </label>
                            </div>
                            <button type="button" class="icon-btn-flat" x-on:click="clear()" x-show="! proofUploading" aria-label="{{ __('Remove capture') }}">
                                <x-heroicon-o-trash class="size-5" />
                            </button>
                        </div>

                        <p class="field-error" x-show="failed" x-cloak role="alert">{{ __('The image could not be uploaded. Check your connection and try again.') }}</p>
                        <p class="field-error" x-show="notAnImage" x-cloak role="alert">{{ __('Attach an image of your payment (JPG, PNG or WEBP).') }}</p>
                        @error('proof') <p class="field-error" role="alert">{{ $message }}</p> @enderror
                    </div>
                </div>
            </fieldset>

            <div class="card p-3.5">
                <label class="flex items-start gap-2.5 cursor-pointer text-xs text-ink-soft select-none">
                    <input type="checkbox" wire:model.live="is_adult" class="mt-0.5 rounded border-line text-brand focus:ring-brand size-4">
                    <span>{{ __('Confirmo que soy mayor de 18 años y acepto participar voluntariamente en esta rifa.') }}</span>
                </label>
                @error('is_adult') <p class="field-error mt-1.5" role="alert">{{ $message }}</p> @enderror
            </div>

            <p class="text-ink-faint flex items-start gap-2 text-xs text-pretty">
                <x-heroicon-o-lock-closed class="mt-px size-4 shrink-0" />
                {{ __('Your numbers stay reserved while the organizer confirms the payment.') }}
            </p>
        </div>

        <div class="border-line bg-canvas pb-safe sticky bottom-0 -mx-4 border-t px-4 pt-3">
            @error('throttle')
                <p class="bg-danger-soft text-danger mb-3 rounded-xl px-4 py-2.5 text-sm font-semibold" role="alert">{{ $message }}</p>
            @enderror

            @if ($errors->any() && ! $errors->has('throttle'))
                <p class="text-danger mb-2 text-center text-sm font-semibold" role="alert">{{ __('Check the highlighted fields.') }}</p>
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
