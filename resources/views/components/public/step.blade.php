@props(['number'])

<legend class="flex items-center gap-2.5">
    <span class="bg-ink text-canvas flex size-6 items-center justify-center rounded-full text-xs font-bold tabular-nums">{{ $number }}</span>
    <span class="section-title text-base">{{ $slot }}</span>
</legend>
