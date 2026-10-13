<div class="pt-safe pb-safe mx-auto flex min-h-full w-full max-w-xl flex-col px-5">
    <div class="flex flex-1 flex-col items-center pt-12 text-center">
        <span class="bg-brand-soft text-brand-ink animate-pop flex size-16 items-center justify-center rounded-full">
            <x-heroicon-m-check class="size-8" />
        </span>

        <h2 id="sheet-title" class="mt-5 text-2xl leading-tight font-extrabold tracking-tight text-balance">{{ __('Payment reported!') }}</h2>
        <p class="text-ink-soft mt-2 text-[0.9375rem] text-pretty">
            {{ __('Your numbers are reserved while :organizer confirms your payment.', ['organizer' => $raffle->team->name]) }}
        </p>

        @if ($payment)
            <section class="card mt-7 w-full p-5 text-left" aria-label="{{ __('Your purchase') }}">
                <h3 class="caption">{{ __('Your numbers') }}</h3>
                <ul class="mt-2 flex flex-wrap gap-1.5">
                    @foreach ($payment->tickets as $ticket)
                        <li class="bg-sunken rounded-lg px-3 py-1.5 font-bold tabular-nums">{{ $ticket->number }}</li>
                    @endforeach
                </ul>

                <dl class="border-line divide-line mt-4 divide-y border-t text-sm">
                    <div class="flex items-center justify-between gap-3 py-3">
                        <dt class="text-ink-soft">{{ __('Status') }}</dt>
                        <dd class="pill bg-warning-soft text-warning">{{ __('Awaiting confirmation') }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 py-3">
                        <dt class="text-ink-soft">{{ __('Amount') }}</dt>
                        <dd class="font-bold tabular-nums">{{ money($payment->amount, $payment->currency)->format() }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 py-3">
                        <dt class="text-ink-soft">{{ __('Payment method') }}</dt>
                        <dd class="truncate font-bold">{{ $payment->paymentMethod->title }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 pt-3">
                        <dt class="text-ink-soft">{{ __('Reference') }}</dt>
                        <dd class="truncate font-bold tabular-nums">{{ $payment->reference }}</dd>
                    </div>
                </dl>
            </section>
        @endif

        <p class="text-ink-faint mt-4 text-[0.8125rem] text-pretty">{{ __('Check the status any time on this page with your ID number.') }}</p>
    </div>

    <div class="space-y-2.5 pt-8">
        <button type="button" class="btn btn-primary w-full" wire:click="finish" wire:loading.attr="disabled" wire:target="finish">{{ __('Done') }}</button>
        <button
            type="button"
            class="btn btn-secondary w-full"
            x-data="shareLink(@js(['title' => $raffle->title, 'text' => __('Join this raffle: :title', ['title' => $raffle->title]), 'url' => $raffle->publicUrl()]))"
            x-on:click="share()"
        >
            <x-heroicon-o-arrow-up-on-square class="size-5" />
            <span x-text="copied ? @js(__('Link copied')) : @js(__('Share raffle'))">{{ __('Share raffle') }}</span>
        </button>
    </div>
</div>
