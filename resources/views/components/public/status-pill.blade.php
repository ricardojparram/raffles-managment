@props(['status', 'solid' => false])

@php
    $tone = match ($status) {
        \App\Enums\SalesStatus::Open => $solid ? 'bg-surface text-brand-ink' : 'bg-brand-soft text-brand-ink',
        \App\Enums\SalesStatus::SoldOut, \App\Enums\SalesStatus::Closed => $solid ? 'bg-surface text-warning' : 'bg-warning-soft text-warning',
        \App\Enums\SalesStatus::Canceled => $solid ? 'bg-surface text-danger' : 'bg-danger-soft text-danger',
        default => $solid ? 'bg-surface text-ink-soft' : 'bg-sunken text-ink-soft',
    };
@endphp

<span {{ $attributes->class(['pill', $tone]) }}>
    <span @class(['size-1.5 rounded-full bg-current', 'animate-pulse' => $status->isOpen()]) aria-hidden="true"></span>
    {{ $status->label() }}
</span>
