<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-10 text-center">
        @if($raffle->img)
            <div class="relative w-full max-w-3xl mx-auto rounded-3xl shadow-xl overflow-hidden mb-8 border border-gray-100 dark:border-gray-800">
                <img src="{{ Storage::url($raffle->img) }}" alt="{{ $raffle->title }}" class="w-full object-cover aspect-video">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                    <div class="p-6 text-left">
                        <h1 class="text-4xl font-extrabold text-white sm:text-5xl drop-shadow-md">
                            {{ $raffle->title }}
                        </h1>
                    </div>
                </div>
            </div>
        @else
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl mb-6">
                {{ $raffle->title }}
            </h1>
        @endif
        <div class="mt-6 flex flex-wrap justify-center gap-4">
            <span class="inline-flex items-center px-5 py-2.5 rounded-full font-extrabold text-sm bg-primary-100 text-primary-700 dark:bg-primary-900/40 dark:text-primary-300 border border-primary-200 dark:border-primary-800 shadow-sm transition-transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                Ticket: ${{ number_format($raffle->ticket_price, 2) }}
            </span>
            <span class="inline-flex items-center px-5 py-2.5 rounded-full font-extrabold text-sm bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300 border border-green-200 dark:border-green-800 shadow-sm transition-transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Quedan {{ ($raffle->total_tickets ?? 100) - count($this->takenNumbers) }} disponibles
            </span>
        </div>
        
        <div class="mt-8 text-xl text-gray-600 dark:text-gray-300 prose dark:prose-invert mx-auto bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">
            {!! $raffle->description !!}
        </div>
    </div>

    @if($raffle->raffle_prizes && $raffle->raffle_prizes->count() > 0)
    <div class="mb-12">
        <h2 class="text-3xl font-black text-center text-gray-900 dark:text-white mb-8">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-primary-700">Premios en Juego</span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($raffle->raffle_prizes as $index => $prize)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700 transform hover:-translate-y-1 transition-all duration-300">
                    <div class="relative">
                        @if($prize->img)
                            <img src="{{ Storage::url($prize->img) }}" alt="{{ $prize->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-primary-600 text-white font-black px-3 py-1 rounded-full shadow-lg text-sm">
                            Premio #{{ $index + 1 }}
                        </div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $prize->title }}</h3>
                        @if($prize->date)
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Sortea el: {{ \Carbon\Carbon::parse($prize->date)->format('d M Y') }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl p-6 sm:p-10 border border-gray-100 dark:border-gray-800">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Reserva tus Tickets</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Completa los pasos a continuación para asegurar tu participación.</p>
        </div>
        <form wire:submit="submit">
            {{ $this->form }}
        </form>
    </div>
</div>