@props(['team'])

<footer class="border-line text-ink-faint mt-10 space-y-1.5 border-t px-2 pt-6 text-center text-xs leading-relaxed">
    @if (filled($team->runlot_number))
        <p class="font-semibold text-ink-soft">{{ __('Registro CONALOT / RUNLOT: :number', ['number' => $team->runlot_number]) }}</p>
    @endif
    <p>{{ __('The raffles on this page are organized and run by :organizer.', ['organizer' => $team->name]) }}</p>
    <p>{{ __(':app only provides the tools to manage them.', ['app' => config('app.name')]) }}</p>
    <p class="text-[11px] text-ink-faint">{{ __('Prohibida la venta a menores de 18 años. Juega con responsabilidad.') }}</p>
</footer>
