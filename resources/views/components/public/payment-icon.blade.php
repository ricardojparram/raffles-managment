@props(['method', 'class' => 'size-full'])

@php
    $type = $method->type;
    $title = strtolower($method->title ?? '');
    $bankKey = $method->bankKey();

    $bankColorClass = match ($bankKey) {
        'bdv' => 'bg-red-600/15 text-red-600 dark:text-red-400',
        'banesco' => 'bg-emerald-600/15 text-emerald-600 dark:text-emerald-400',
        'mercantil' => 'bg-blue-600/15 text-blue-600 dark:text-blue-400',
        'provincial' => 'bg-indigo-600/15 text-indigo-600 dark:text-indigo-400',
        'bancamiga' => 'bg-cyan-600/15 text-cyan-600 dark:text-cyan-400',
        'bnc' => 'bg-teal-600/15 text-teal-600 dark:text-teal-400',
        default => null,
    };
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center justify-center overflow-hidden shrink-0']) }}>
    @if ($type === \App\Enums\PaymentMethodType::Zelle || str_contains($title, 'zelle'))
        {{-- simple-icons:zelle from icones.js.org --}}
        <span class="flex size-full items-center justify-center rounded-lg bg-[#7414CA]/15 text-[#7414CA] dark:text-[#a855f7]" title="Zelle">
            <svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M13.559 24h-2.841a.483.483 0 0 1-.483-.483v-2.765H5.638a.667.667 0 0 1-.666-.666v-2.234a.67.67 0 0 1 .142-.412l8.139-10.382h-7.25a.667.667 0 0 1-.667-.667V3.914c0-.367.299-.666.666-.666h4.23V.483c0-.266.217-.483.483-.483h2.841c.266 0 .483.217.483.483v2.765h4.323c.367 0 .666.299.666.666v2.137a.67.67 0 0 1-.141.41l-8.19 10.481h7.665c.367 0 .666.299.666.666v2.477a.667.667 0 0 1-.666.667h-4.32v2.765a.483.483 0 0 1-.483.483"/>
            </svg>
        </span>
    @elseif ($type === \App\Enums\PaymentMethodType::Binance || str_contains($title, 'binance'))
        {{-- simple-icons:binance from icones.js.org --}}
        <span class="flex size-full items-center justify-center rounded-lg bg-[#F3BA2F]/15 text-[#F3BA2F]" title="Binance Pay">
            <svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="m16.624 13.92l2.718 2.716l-7.353 7.353l-7.353-7.352l2.717-2.717l4.636 4.66zm4.637-4.636L24 12l-2.715 2.716L18.568 12zm-9.272 0l2.716 2.692l-2.717 2.717L9.272 12zm-9.273 0L5.41 12l-2.692 2.692L0 12zM11.99.012l7.35 7.328l-2.717 2.715L11.99 5.42l-4.636 4.66l-2.717-2.716z"/>
            </svg>
        </span>
    @elseif ($type === \App\Enums\PaymentMethodType::PagoMovil || str_contains($title, 'movil'))
        {{-- tabler:device-mobile-dollar from icones.js.org --}}
        <span class="flex size-full items-center justify-center rounded-lg {{ $bankColorClass ?? 'bg-brand-soft text-brand-ink' }}" title="Pago Móvil">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M13 21H8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v5m-7-6h2m-1 13v.01M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3H17m2 0v1m0-8v1"/>
            </svg>
        </span>
    @elseif ($type === \App\Enums\PaymentMethodType::Transferencia || str_contains($title, 'transferencia') || $bankKey !== null)
        {{-- tabler:building-bank from icones.js.org --}}
        <span class="flex size-full items-center justify-center rounded-lg {{ $bankColorClass ?? 'bg-sky-600/15 text-sky-600 dark:text-sky-400' }}" title="Transferencia Bancaria">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M3 21h18M3 10h18M5 6l7-3l7 3M4 10v11m16-11v11M8 14v3m4-3v3m4-3v3"/>
            </svg>
        </span>
    @else
        {{-- tabler:credit-card from icones.js.org --}}
        <span class="flex size-full items-center justify-center rounded-lg bg-sunken text-ink-soft">
            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect width="18" height="14" x="3" y="5" rx="2"/>
                <path d="M3 10h18M7 15h.01M11 15h2"/>
            </svg>
        </span>
    @endif
</div>
