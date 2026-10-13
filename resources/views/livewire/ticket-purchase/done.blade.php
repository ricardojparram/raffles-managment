<div class="pt-safe pb-safe mx-auto flex min-h-full w-full max-w-xl flex-col px-5">
    <div class="flex flex-1 flex-col items-center pt-10 text-center">
        <span class="bg-success-soft text-success animate-pop flex size-20 items-center justify-center rounded-full">
            <x-heroicon-m-check class="size-10" />
        </span>

        <h2 id="sheet-title" class="mt-5 text-2xl font-extrabold tracking-tight text-balance">{{ __('Payment reported!') }}</h2>
        <p class="text-ink-soft mt-2 text-pretty">
            {{ __('Your numbers are reserved while :organizer confirms your payment.', ['organizer' => $raffle->team->name]) }}
        </p>

        @if ($payment)
            <section class="card mt-6 w-full p-5 text-left" aria-label="{{ __('Your purchase') }}">
                <h3 class="eyebrow">{{ __('Your numbers') }}</h3>
                <ul class="mt-2 flex flex-wrap gap-1.5">
                    @foreach ($payment->tickets as $ticket)
                        <li class="bg-brand-soft text-brand-ink rounded-full px-3 py-1 font-bold tabular-nums">{{ $ticket->number }}</li>
                    @endforeach
                </ul>

                <dl class="border-line divide-line mt-4 divide-y border-t text-sm">
                    <div class="flex items-center justify-between gap-3 py-2.5">
                        <dt class="text-ink-soft">{{ __('Status') }}</dt>
                        <dd class="bg-warning-soft text-warning status-pill">{{ __('Awaiting confirmation') }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 py-2.5">
                        <dt class="text-ink-soft">{{ __('Amount') }}</dt>
                        <dd class="font-semibold tabular-nums">{{ money($payment->amount, $payment->currency)->format() }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 py-2.5">
                        <dt class="text-ink-soft">{{ __('Payment method') }}</dt>
                        <dd class="truncate font-semibold">{{ $payment->paymentMethod->title }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 pt-2.5">
                        <dt class="text-ink-soft">{{ __('Reference') }}</dt>
                        <dd class="truncate font-semibold tabular-nums">{{ $payment->reference }}</dd>
                    </div>
                </dl>
            </section>
        @endif

        <p class="text-ink-faint mt-4 text-sm text-pretty">{{ __('Check the status any time on this page with your ID number.') }}</p>
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
