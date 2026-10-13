<?php

namespace App\Livewire;

use App\Enums\PaymentStatus;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Raffle;
use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;

/**
 * Lets a buyer look up the numbers they hold in a raffle with their ID number.
 */
class TicketChecker extends Component
{
    /**
     * Lookups a single visitor may run per minute for one raffle.
     */
    public const MAX_ATTEMPTS = 20;

    #[Locked]
    public Raffle $raffle;

    public string $dni = '';

    /**
     * @var array{name: string|null, tickets: list<array{number: string, confirmed: bool}>, rejected: list<string>}|null
     */
    #[Locked]
    public ?array $result = null;

    public function check(): void
    {
        $this->result = null;
        $this->dni = preg_replace('/\D/', '', $this->dni);

        $this->validate(
            ['dni' => ['required', 'string', 'regex:/^\d{6,9}$/']],
            ['dni.*' => __('Enter your ID with numbers only, e.g. 12345678.')],
        );

        $throttleKey = "ticket-checker:{$this->raffle->id}:".request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $this->addError('dni', __('Too many attempts. Wait a few minutes and try again.'));

            return;
        }

        RateLimiter::hit($throttleKey);

        $customer = Customer::query()
            ->withoutGlobalScopes()
            ->where('team_id', $this->raffle->team_id)
            ->where('dni', $this->dni)
            ->first();

        $this->result = [
            'name' => $customer ? $this->mask($customer->name).' '.$this->mask($customer->lastname) : null,
            'tickets' => $customer ? $this->tickets($customer) : [],
            'rejected' => $customer ? $this->rejectedReferences($customer) : [],
        ];
    }

    public function render(): View
    {
        return view('livewire.ticket-checker');
    }

    /**
     * @return list<array{number: string, confirmed: bool}>
     */
    private function tickets(Customer $customer): array
    {
        return Ticket::query()
            ->with('payment')
            ->where('raffle_id', $this->raffle->id)
            ->where('customer_id', $customer->id)
            ->orderBy('number')
            ->get()
            ->map(fn (Ticket $ticket): array => [
                'number' => $ticket->number,
                'confirmed' => $ticket->payment === null || $ticket->payment->status === PaymentStatus::Confirmed->value,
            ])
            ->all();
    }

    /**
     * @return list<string>
     */
    private function rejectedReferences(Customer $customer): array
    {
        return Payment::query()
            ->withoutGlobalScopes()
            ->where('raffle_id', $this->raffle->id)
            ->where('customer_id', $customer->id)
            ->where('status', PaymentStatus::Rejected->value)
            ->latest('id')
            ->pluck('reference')
            ->map(fn (?string $reference): string => '•••• '.Str::substr((string) $reference, -4))
            ->all();
    }

    private function mask(string $value): string
    {
        return Str::substr($value, 0, 1).'••••';
    }
}
