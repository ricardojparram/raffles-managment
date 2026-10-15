@props(['method', 'class' => 'size-full'])

@php
    $bankKey = $method->bankKey();
    $type = $method->type;
    $title = strtolower($method->title ?? '');
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center justify-center overflow-hidden shrink-0']) }}>
    @if ($bankKey === 'bdv')
        <span class="flex size-full items-center justify-center rounded-lg bg-red-600/15 font-black text-red-600 dark:text-red-400 text-xs tracking-tighter" title="Banco de Venezuela">
            BDV
        </span>
    @elseif ($bankKey === 'banesco')
        <span class="flex size-full items-center justify-center rounded-lg bg-emerald-600/15 font-black text-emerald-600 dark:text-emerald-400 text-xs tracking-tighter" title="Banesco">
            BAN
        </span>
    @elseif ($bankKey === 'mercantil')
        <span class="flex size-full items-center justify-center rounded-lg bg-blue-600/15 font-black text-blue-600 dark:text-blue-400 text-xs tracking-tighter" title="Banco Mercantil">
            MER
        </span>
    @elseif ($bankKey === 'provincial')
        <span class="flex size-full items-center justify-center rounded-lg bg-indigo-600/15 font-black text-indigo-600 dark:text-indigo-400 text-[10px] tracking-tight" title="BBVA Provincial">
            BBVA
        </span>
    @elseif ($bankKey === 'bancamiga')
        <span class="flex size-full items-center justify-center rounded-lg bg-cyan-600/15 font-black text-cyan-600 dark:text-cyan-400 text-[10px] tracking-tight" title="Bancamiga">
            BAM
        </span>
    @elseif ($bankKey === 'bnc')
        <span class="flex size-full items-center justify-center rounded-lg bg-teal-600/15 font-black text-teal-600 dark:text-teal-400 text-xs tracking-tight" title="Banco Nacional de Crédito">
            BNC
        </span>
    @elseif ($type === \App\Enums\PaymentMethodType::Zelle || str_contains($title, 'zelle'))
        <span class="flex size-full items-center justify-center rounded-lg bg-purple-600/15 text-purple-600 dark:text-purple-400 font-extrabold text-sm" title="Zelle">
            <svg class="size-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M4 6h14.5l-9.5 12H20v2H4.5l9.5-12H4V6z"/>
            </svg>
        </span>
    @elseif ($type === \App\Enums\PaymentMethodType::Binance || str_contains($title, 'binance'))
        <span class="flex size-full items-center justify-center rounded-lg bg-amber-500/15 text-amber-500 font-bold" title="Binance Pay">
            <svg class="size-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 3.09L9.18 11 6.09 7.91 12 2zm6 6l3.09 3.09L15.18 17l-3.09-3.09L18 8zM6 8l3.09 3.09L3.18 17 .09 13.91 6 8zm6 6l3.09 3.09L12 20.18l-3.09-3.09L12 14z"/>
            </svg>
        </span>
    @elseif ($type === \App\Enums\PaymentMethodType::PagoMovil || str_contains($title, 'movil'))
        <span class="flex size-full items-center justify-center rounded-lg bg-brand-soft text-brand-ink" title="Pago Móvil">
            <x-heroicon-o-device-phone-mobile class="size-5" />
        </span>
    @elseif ($type === \App\Enums\PaymentMethodType::Transferencia || str_contains($title, 'transferencia'))
        <span class="flex size-full items-center justify-center rounded-lg bg-sky-600/15 text-sky-600 dark:text-sky-400" title="Transferencia Bancaria">
            <x-heroicon-o-building-library class="size-5" />
        </span>
    @else
        <span class="flex size-full items-center justify-center rounded-lg bg-sunken text-ink-soft">
            <x-heroicon-o-credit-card class="size-5" />
        </span>
    @endif
</div>
