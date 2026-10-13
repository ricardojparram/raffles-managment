<x-layouts.public>
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 py-16 sm:py-24 lg:py-32 flex flex-col items-center text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Bienvenido a</span>
                    <span class="block text-primary-600 mt-2">{{ $team->name }}</span>
                </h1>
                <p class="mt-6 text-base text-gray-500 sm:text-lg sm:max-w-xl md:text-xl">
                    Participa en nuestras increíbles rifas y gana grandes premios. Elige tus números de la suerte y asegura tu participación hoy mismo.
                </p>
            </div>
        </div>
    </div>

    <!-- Raffles List Section -->
    <div class="bg-gray-50 py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl font-extrabold text-gray-900">Rifas Activas</h2>
                <p class="mt-2 text-gray-600">No dejes pasar la oportunidad, los tickets vuelan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($raffles as $raffle)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
                        @if($raffle->img)
                            <div class="aspect-w-16 aspect-h-9 w-full bg-gray-200">
                                <img src="{{ Storage::url($raffle->img) }}" alt="{{ $raffle->title }}" class="w-full h-56 object-cover">
                            </div>
                        @else
                            <div class="w-full h-56 bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                                <span class="text-white font-bold text-2xl text-center px-4">{{ $raffle->title }}</span>
                            </div>
                        @endif

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $raffle->title }}</h3>
                            <p class="text-gray-500 text-sm flex-grow line-clamp-3 mb-6">
                                {{ $raffle->description ?? 'Participa y gana fantásticos premios con esta rifa.' }}
                            </p>
                            
                            <div class="mt-auto">
                                <div class="flex justify-between items-center mb-5 p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <div class="text-sm">
                                        <span class="text-gray-500 block mb-1">Precio del ticket</span>
                                        <span class="font-black text-2xl text-primary-600">${{ number_format($raffle->ticket_price ?? 0, 2) }}</span>
                                    </div>
                                    <div class="text-right text-sm">
                                        <span class="text-gray-500 block mb-1">Total Tickets</span>
                                        <span class="font-bold text-gray-900 text-lg">{{ $raffle->total_tickets ?? 100 }}</span>
                                    </div>
                                </div>
                                
                                <a href="{{ route('public.raffle.show', ['team_slug' => $team->slug, 'raffle_slug' => $raffle->slug]) }}" 
                                   class="w-full inline-flex justify-center items-center px-4 py-3 text-sm font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-500 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 transition-all">
                                    Participar Ahora
                                    <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 px-6 text-center bg-white rounded-3xl border-2 border-dashed border-gray-300">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Sin rifas activas</h3>
                        <p class="mt-2 text-gray-500">Pronto publicaremos nuevas oportunidades. ¡Mantente atento!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.public>
