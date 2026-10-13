@props(['team'])

<footer class="border-line text-ink-faint mt-10 space-y-1 border-t px-2 pt-6 text-center text-xs leading-relaxed">
    <p>{{ __('The raffles on this page are organized and run by :organizer.', ['organizer' => $team->name]) }}</p>
    <p>{{ __(':app only provides the tools to manage them.', ['app' => config('app.name')]) }}</p>
</footer>
