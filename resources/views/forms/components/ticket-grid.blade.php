<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    @php
        $raffle = $this->raffle;
        $totalTickets = $raffle->total_tickets ?? 100;
        $takenNumbers = $this->takenNumbers;
        
        $offers = $raffle->offers()->orderByDesc('ticket_amount')->get()->map(function ($offer) {
            return [
                'amount' => $offer->ticket_amount,
                'price' => $offer->price
            ];
        })->values()->toArray();
        $basePrice = $raffle->ticket_price ?? 0;
    @endphp

    <div 
        x-data="{
            state: $wire.$entangle('{{ $getStatePath() }}'),
            taken: {{ json_encode($takenNumbers) }},
            offers: {{ json_encode($offers) }},
            basePrice: {{ $basePrice }},
            
            toggleNumber(num) {
                if (this.taken.includes(num)) return;
                
                if (!Array.isArray(this.state)) {
                    this.state = [];
                }

                if (this.state.includes(num)) {
                    this.state = this.state.filter(n => n !== num);
                } else {
                    this.state.push(num);
                }
            },
            
            getTotal() {
                let count = this.state ? this.state.length : 0;
                if (count === 0) return 0;
                
                let total = 0;
                let remaining = count;
                
                if (this.offers.length > 0) {
                    for (let i = 0; i < this.offers.length; i++) {
                        let offer = this.offers[i];
                        if (remaining >= offer.amount) {
                            let offerCount = Math.floor(remaining / offer.amount);
                            total += offerCount * offer.price;
                            remaining = remaining % offer.amount;
                        }
                    }
                }
                
                total += remaining * this.basePrice;
                return total.toFixed(2);
            }
        }"
        class="w-full relative"
    >
        @if(count($offers) > 0)
            <div class="mb-4 bg-primary-50 dark:bg-primary-900/30 border border-primary-200 dark:border-primary-800 rounded-xl p-4">
                <h4 class="text-primary-800 dark:text-primary-300 font-bold mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    ¡Ofertas Especiales!
                </h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($offers as $offer)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-white dark:bg-gray-800 text-primary-700 dark:text-primary-400 shadow-sm border border-primary-100 dark:border-gray-700">
                            {{ $offer['amount'] }} tickets por ${{ number_format($offer['price'], 2) }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-4 flex flex-col sm:flex-row justify-between items-center bg-gray-50 dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-inner">
            <div class="text-gray-700 dark:text-gray-300 text-lg mb-2 sm:mb-0 flex items-center gap-4">
                <div>
                    Tickets seleccionados: <span x-text="state && state.length ? state.length : 0" class="font-black text-primary-600 dark:text-primary-400 text-2xl"></span>
                </div>
                <div class="text-sm font-medium px-3 py-1 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400 rounded-full border border-green-200 dark:border-green-800">
                    Quedan {{ $totalTickets - count($takenNumbers) }} disponibles
                </div>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500 dark:text-gray-400">Total acumulado</div>
                <div class="text-3xl font-black text-gray-900 dark:text-white">$<span x-text="getTotal()"></span></div>
            </div>
        </div>

        <div class="grid grid-cols-5 sm:grid-cols-10 gap-2 sm:gap-3 overflow-y-auto max-h-96 p-2 rounded-xl bg-gray-50/50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
            @foreach(range(0, $totalTickets - 1) as $i)
                @php
                    $number = str_pad($i, strlen((string)($totalTickets - 1)), '0', STR_PAD_LEFT);
                    $isTaken = in_array($number, $takenNumbers);
                @endphp
                <button 
                    type="button"
                    @if($isTaken) disabled @endif
                    x-on:click="toggleNumber('{{ $number }}')"
                    x-bind:class="{
                        'bg-primary-600 text-white border-primary-600 shadow-md transform scale-105': state && state.includes('{{ $number }}'),
                        'bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:border-primary-500 hover:text-primary-600 hover:shadow': !state || !state.includes('{{ $number }}'),
                        'opacity-40 cursor-not-allowed bg-gray-200 dark:bg-gray-800 !border-gray-300 dark:!border-gray-700 text-gray-400 dark:text-gray-500': {{ $isTaken ? 'true' : 'false' }}
                    }"
                    class="border-2 rounded-lg text-center py-3 text-lg font-bold transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                >
                    {{ $number }}
                </button>
            @endforeach
        </div>
        
        <p x-show="!state || state.length === 0" x-transition class="mt-3 text-sm font-medium text-danger-600 dark:text-danger-400" style="display: none;">
            * Debes seleccionar al menos un número para continuar con el pago.
        </p>
    </div>
</x-dynamic-component>
