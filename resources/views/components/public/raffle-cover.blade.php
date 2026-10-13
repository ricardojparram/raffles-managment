@props(['raffle', 'eager' => false])

@if ($image = $raffle->imageUrl())
    <img
        src="{{ $image }}"
        alt="{{ $raffle->title }}"
        width="800"
        height="600"
        decoding="async"
        @if ($eager) fetchpriority="high" @else loading="lazy" @endif
        {{ $attributes->class('size-full object-cover') }}
    >
@else
    <div {{ $attributes->class('from-brand-soft to-sunken text-brand-ink flex size-full items-center justify-center bg-linear-to-br') }} aria-hidden="true">
        <x-heroicon-o-gift class="size-14 opacity-60" />
    </div>
@endif
