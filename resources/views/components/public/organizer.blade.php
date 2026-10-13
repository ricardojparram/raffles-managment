@props(['team', 'href' => null])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }} @if ($href) href="{{ $href }}" @endif {{ $attributes->class(['flex min-w-0 items-center gap-2.5 rounded-full py-1 pr-3', 'transition hover:opacity-80' => $href]) }}>
    <span class="bg-ink text-canvas flex size-10 shrink-0 items-center justify-center rounded-full text-sm font-bold uppercase" aria-hidden="true">
        {{ mb_substr($team->name, 0, 1) }}
    </span>
    <span class="min-w-0 leading-tight">
        <span class="text-ink-faint block text-xs">{{ __('Organized by') }}</span>
        <span class="block truncate text-sm font-semibold">{{ $team->name }}</span>
    </span>
</{{ $tag }}>
