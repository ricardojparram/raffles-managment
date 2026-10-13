<?php

namespace App\Livewire\Public;

use App\Models\Raffle;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class RaffleShow extends Component implements HasForms
{
    use InteractsWithForms;

    public Team $team;
    public Raffle $raffle;

    public ?array $data = [];
    public array $takenNumbers = [];

    public function mount(string $team_slug, string $raffle_slug)
    {
        $this->team = Team::where('slug', $team_slug)->firstOrFail();
        $this->raffle = $this->team->raffles()->where('slug', $raffle_slug)->firstOrFail();
        
        $this->loadTakenNumbers();

        $this->form->fill();
    }

    public function loadTakenNumbers()
    {
        $this->takenNumbers = $this->raffle->tickets()->pluck('number')->toArray();
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Números')
                        ->schema([
                            ViewField::make('selectedNumbers')
                                ->view('forms.components.ticket-grid')
                                ->required()
                                ->rules(['array', 'min:1']),
                        ]),
                    Wizard\Step::make('Datos')
                        ->columns(2)
                        ->schema([
                            TextInput::make('customerName')
                                ->label('Nombre')
                                ->prefixIcon('heroicon-m-user')
                                ->extraAlpineAttributes([
                                    'x-init' => "if(localStorage.getItem('cust_name')) { \$el.value = localStorage.getItem('cust_name'); \$el.dispatchEvent(new Event('input')) }",
                                    'x-on:blur' => "localStorage.setItem('cust_name', \$el.value)"
                                ])
                                ->required()
                                ->maxLength(255),
                            TextInput::make('customerLastname')
                                ->label('Apellido')
                                ->prefixIcon('heroicon-m-user')
                                ->extraAlpineAttributes([
                                    'x-init' => "if(localStorage.getItem('cust_lastname')) { \$el.value = localStorage.getItem('cust_lastname'); \$el.dispatchEvent(new Event('input')) }",
                                    'x-on:blur' => "localStorage.setItem('cust_lastname', \$el.value)"
                                ])
                                ->required()
                                ->maxLength(255),
                            TextInput::make('customerDni')
                                ->label('DNI / Documento')
                                ->prefixIcon('heroicon-m-identification')
                                ->columnSpanFull()
                                ->extraAlpineAttributes([
                                    'x-init' => "if(localStorage.getItem('cust_dni')) { \$el.value = localStorage.getItem('cust_dni'); \$el.dispatchEvent(new Event('input')) }",
                                    'x-on:blur' => "localStorage.setItem('cust_dni', \$el.value)"
                                ])
                                ->required()
                                ->maxLength(255),
                            TextInput::make('customerPhone')
                                ->label('Teléfono')
                                ->prefixIcon('heroicon-m-phone')
                                ->columnSpanFull()
                                ->extraAlpineAttributes([
                                    'x-init' => "if(localStorage.getItem('cust_phone')) { \$el.value = localStorage.getItem('cust_phone'); \$el.dispatchEvent(new Event('input')) }",
                                    'x-on:blur' => "localStorage.setItem('cust_phone', \$el.value)"
                                ])
                                ->tel()
                                ->required()
                                ->maxLength(20),
                            TextInput::make('customerEmail')
                                ->label('Email')
                                ->prefixIcon('heroicon-m-envelope')
                                ->columnSpanFull()
                                ->extraAlpineAttributes([
                                    'x-init' => "if(localStorage.getItem('cust_email')) { \$el.value = localStorage.getItem('cust_email'); \$el.dispatchEvent(new Event('input')) }",
                                    'x-on:blur' => "localStorage.setItem('cust_email', \$el.value)"
                                ])
                                ->email()
                                ->maxLength(255),
                        ]),
                    Wizard\Step::make('Pago')
                        ->schema([
                            Placeholder::make('total')
                                ->label('Total a Pagar')
                                ->content(function ($get) {
                                    $selected = $get('selectedNumbers');
                                    $count = is_array($selected) ? count($selected) : 0;
                                    
                                    $offers = $this->raffle->offers()->orderByDesc('ticket_amount')->get();
                                    $basePrice = $this->raffle->ticket_price;
                                    $totalAmount = 0;
                                    
                                    if ($offers->isNotEmpty()) {
                                        $remaining = $count;
                                        foreach ($offers as $offer) {
                                            if ($remaining >= $offer->ticket_amount) {
                                                $offerCount = floor($remaining / $offer->ticket_amount);
                                                $totalAmount += $offerCount * $offer->price;
                                                $remaining %= $offer->ticket_amount;
                                            }
                                        }
                                        $totalAmount += $remaining * $basePrice;
                                    } else {
                                        $totalAmount = $count * $basePrice;
                                    }

                                    return new HtmlString('<span class="text-3xl font-black text-primary-600">$' . number_format($totalAmount, 2) . '</span>');
                                }),
                            Radio::make('payment_method_id')
                                ->label('Método de Pago')
                                ->options($this->team->paymentMethods->mapWithKeys(function ($method) {
                                    $html = "<div class='flex items-center gap-2'>";
                                    if ($method->icon) {
                                        $html .= "<img src='" . \Illuminate\Support\Facades\Storage::url($method->icon) . "' alt='{$method->title}' class='h-6 w-auto rounded-md object-contain'>";
                                    }
                                    $html .= "<span class='font-bold'>{$method->title}</span></div>";
                                    return [$method->id => new HtmlString($html)];
                                })->toArray())
                                ->descriptions($this->team->paymentMethods->mapWithKeys(function ($method) {
                                    $desc = $method->description;
                                    if (is_array($desc)) {
                                        $formatted = "<div class='mt-2 space-y-2 bg-gray-50 dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700'>";
                                        foreach ($desc as $key => $value) {
                                            $label = is_numeric($key) ? '' : "<strong>{$key}:</strong>";
                                            $formatted .= "
                                                <div class='flex items-center justify-between text-sm gap-2'>
                                                    <div>{$label} <span class='text-gray-700 dark:text-gray-300'>{$value}</span></div>
                                                    <button type='button' x-on:click.prevent=\"navigator.clipboard.writeText('{$value}'); \$tooltip('¡Copiado!')\" class='text-gray-400 hover:text-primary-600 transition-colors p-1 bg-white dark:bg-gray-700 rounded-md border border-gray-200 dark:border-gray-600 shadow-sm'>
                                                        <svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z'></path></svg>
                                                    </button>
                                                </div>
                                            ";
                                        }
                                        $formatted .= "</div>";
                                        $desc = new HtmlString($formatted);
                                    }
                                    return [$method->id => $desc];
                                })->toArray())
                                ->required(),
                            TextInput::make('reference_number')
                                ->label('Número de Referencia')
                                ->required()
                                ->maxLength(255),
                            FileUpload::make('receipt_img')
                                ->label('Comprobante de Pago')
                                ->image()
                                ->directory('receipts')
                                ->required(),
                        ]),
                ])->submitAction(new HtmlString('<button type="submit" class="fi-btn fi-btn-size-md fi-btn-color-primary fi-btn-style-solid">Confirmar Reserva</button>'))
            ])
            ->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState();

        try {
            DB::beginTransaction();

            $this->loadTakenNumbers();

            $selectedNumbers = $data['selectedNumbers'] ?? [];
            $conflicts = array_intersect($selectedNumbers, $this->takenNumbers);
            
            if (count($conflicts) > 0) {
                DB::rollBack();
                $data['selectedNumbers'] = array_values(array_diff($selectedNumbers, $conflicts));
                $this->form->fill($data);
                
                Notification::make()
                    ->danger()
                    ->title('Números no disponibles')
                    ->body('Algunos de los números que elegiste acaban de ser reservados. Por favor, elige otros.')
                    ->send();
                return;
            }

            $customer = $this->team->customers()->firstOrCreate(
                ['phone' => $data['customerPhone']],
                [
                    'name' => $data['customerName'],
                    'lastname' => $data['customerLastname'],
                    'dni' => $data['customerDni'],
                    'email' => $data['customerEmail']
                ]
            );

            $offers = $this->raffle->offers()->orderByDesc('ticket_amount')->get();
            $basePrice = $this->raffle->ticket_price;
            $count = count($selectedNumbers);
            $totalAmount = 0;
            
            if ($offers->isNotEmpty()) {
                $remaining = $count;
                foreach ($offers as $offer) {
                    if ($remaining >= $offer->ticket_amount) {
                        $offerCount = floor($remaining / $offer->ticket_amount);
                        $totalAmount += $offerCount * $offer->price;
                        $remaining %= $offer->ticket_amount;
                    }
                }
                $totalAmount += $remaining * $basePrice;
            } else {
                $totalAmount = $count * $basePrice;
            }
            
            $payment = Payment::create([
                'team_id' => $this->team->id,
                'customer_id' => $customer->id,
                'payment_method_id' => $data['payment_method_id'],
                'amount' => $totalAmount,
                'reference_number' => $data['reference_number'],
                'img' => $data['receipt_img'],
                'status' => 'pending'
            ]);

            foreach ($selectedNumbers as $number) {
                Ticket::create([
                    'raffle_id' => $this->raffle->id,
                    'customer_id' => $customer->id,
                    'payment_id' => $payment->id,
                    'number' => $number,
                    'status' => 'reserved'
                ]);
            }

            DB::commit();

            $this->form->fill();
            $this->loadTakenNumbers();

            Notification::make()
                ->success()
                ->title('¡Reserva Exitosa!')
                ->body('Tus números han sido reservados y tu comprobante fue enviado para verificación.')
                ->send();

        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Reservation error: ' . $e->getMessage());
            Notification::make()
                ->danger()
                ->title('Error')
                ->body('Ocurrió un error al procesar tu reserva. Intenta de nuevo.')
                ->send();
        }
    }

    public function render()
    {
        return view('livewire.public.raffle-show')
            ->layout('components.layouts.public');
    }
}
