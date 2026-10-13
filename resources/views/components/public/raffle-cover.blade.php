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
    <div {{ $attributes->class('bg-sunken text-ink-faint flex size-full items-center justify-center') }} aria-hidden="true">
        <x-heroicon-o-gift class="size-1/3 max-h-16" />
    </div>
@endif
