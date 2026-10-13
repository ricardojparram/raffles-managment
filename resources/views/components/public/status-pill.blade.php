@props(['status'])

@php
    $tone = match ($status) {
        \App\Enums\SalesStatus::Open => 'bg-success-soft text-success',
        \App\Enums\SalesStatus::SoldOut, \App\Enums\SalesStatus::Closed => 'bg-warning-soft text-warning',
        \App\Enums\SalesStatus::Canceled => 'bg-danger-soft text-danger',
        default => 'bg-sunken text-ink-soft',
    };
@endphp

<span {{ $attributes->class(['status-pill', $tone]) }}>
    <span @class(['size-1.5 rounded-full bg-current', 'animate-pulse' => $status->isOpen()]) aria-hidden="true"></span>
    {{ $status->label() }}
</span>
