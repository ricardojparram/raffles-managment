<?php

namespace App\Livewire;

use App\Actions\ReserveTickets;
use App\Exceptions\ReservationFailed;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use App\Services\ExchangeRateService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

/**
 * Public number board and checkout where a buyer picks numbers and reports a payment.
 */
class TicketPurchase extends Component
{
    use WithFileUploads;

    /**
     * Payment reports a single visitor may send for one raffle before being throttled.
     */
    public const MAX_ATTEMPTS = 15;

    private const ATTEMPTS_DECAY_SECONDS = 600;

    /**
     * State kept in the session so a reload, common when switching to the bank app, loses nothing.
     */
    private const REMEMBERED = ['selected', 'step', 'dni', 'name', 'lastname', 'phone', 'paymentMethodId', 'reference'];

    private const REMEMBERED_AFTER_PURCHASE = ['dni', 'name', 'lastname', 'phone', 'paymentMethodId'];

    #[Locked]
    public Raffle $raffle;

    /**
     * @var list<string>
     */
    public array $selected = [];

    public int $page = 0;

    public string $search = '';

    #[Locked]
    public string $step = 'pick';

    public string $dni = '';

    public string $name = '';

    public string $lastname = '';

    public string $phone = '';

    public ?int $paymentMethodId = null;

    public string $reference = '';

    /**
     * @var TemporaryUploadedFile|null
     */
    public $proof = null;

    #[Locked]
    public ?float $rate = null;

    #[Locked]
    public ?int $paymentId = null;

    private ?int $availableCount = null;

    public function mount(): void
    {
        $this->fill(Arr::only(session($this->sessionKey(), []), self::REMEMBERED));

        if ($this->step === 'pay') {
            $this->step = 'pick';
            $this->checkout();
        }
    }

    public function dehydrate(): void
    {
        session()->put($this->sessionKey(), $this->only(
            $this->step === 'done' ? self::REMEMBERED_AFTER_PURCHASE : self::REMEMBERED,
        ));
    }

    public function showPage(int $page): void
    {
        $this->page = max(0, min($page, $this->pageCount() - 1));
    }

    public function findNumber(): void
    {
        $this->resetErrorBag('search');

        $digits = preg_replace('/\D/', '', $this->search);

        if ($digits === '') {
            $this->addError('search', __('Type the number you are looking for.'));

            return;
        }

        $number = str_pad($digits, $this->raffle->numberLength(), '0', STR_PAD_LEFT);

        if (! $this->raffle->hasNumber($number)) {
            $this->addError('search', __('This raffle goes from :first to :last.', [
                'first' => $this->raffle->formatNumber(0),
                'last' => $this->raffle->formatNumber($this->raffle->ticket_amount - 1),
            ]));

            return;
        }

        $this->page = intdiv((int) $number, Raffle::NUMBERS_PER_PAGE);

        if ($this->raffle->tickets()->where('number', $number)->exists()) {
            $this->addError('search', __('Number :number is already taken.', ['number' => $number]));

            return;
        }

        if (! in_array($number, $this->selected, true)) {
            if (count($this->selected) >= $this->maximum()) {
                $this->addError('search', __('You reached the limit of :max tickets per purchase.', ['max' => $this->maximum()]));

                return;
            }

            $this->selected[] = $number;
        }

        $this->search = '';
    }

    public function addRandom(int $count): void
    {
        $this->resetErrorBag('selected');

        $selected = $this->validNumbers($this->selected);
        $count = min($count, $this->maximum() - count($selected));

        $this->selected = [...$selected, ...$this->raffle->randomAvailableNumbers($count, $selected)];
    }

    public function checkout(): void
    {
        $this->resetErrorBag();

        if (! $this->selectionIsReady()) {
            return;
        }

        $methods = $this->paymentMethods;

        $this->rate = $methods->contains(fn (PaymentMethod $method): bool => $method->currency !== $this->raffle->currency)
            ? app(ExchangeRateService::class)->usdToVed()
            : null;

        if ($methods->count() === 1) {
            $this->paymentMethodId = $methods->first()->id;
        } elseif (! $methods->contains('id', $this->paymentMethodId)) {
            $this->paymentMethodId = null;
        }

        $this->step = 'pay';
    }

    public function backToNumbers(): void
    {
        if ($this->step === 'pay') {
            $this->step = 'pick';
        }
    }

    public function removeProof(): void
    {
        $this->proof = null;
        $this->resetErrorBag('proof');
    }

    public function submit(ReserveTickets $reserveTickets): void
    {
        if ($this->step !== 'pay') {
            return;
        }

        $this->cleanInput();
        $this->validate();

        $throttleKey = "ticket-purchase:{$this->raffle->id}:".request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $this->addError('throttle', __('Too many attempts. Wait a few minutes and try again.'));

            return;
        }

        RateLimiter::hit($throttleKey, self::ATTEMPTS_DECAY_SECONDS);

        try {
            $payment = $reserveTickets->handle(
                raffle: $this->raffle,
                buyer: [
                    'dni' => $this->dni,
                    'name' => $this->name,
                    'lastname' => $this->lastname,
                    'phone' => Customer::normalizePhone($this->phone),
                ],
                numbers: $this->selected,
                paymentMethod: $this->paymentMethods->firstWhere('id', $this->paymentMethodId),
                reference: $this->reference,
                proof: $this->proof,
                usdToVedRate: $this->rate,
            );
        } catch (ReservationFailed $exception) {
            $this->recoverFrom($exception);

            return;
        }

        $this->paymentId = $payment->id;
        $this->step = 'done';
        $this->reset('selected', 'reference', 'proof', 'search');
    }

    public function finish(): void
    {
        $this->reset('selected', 'reference', 'proof', 'search', 'paymentId', 'rate');
        $this->resetErrorBag();
        $this->step = 'pick';
    }

    /**
     * @return Collection<int, PaymentMethod>
     */
    #[Computed]
    public function paymentMethods(): Collection
    {
        return $this->raffle->team->paymentMethods()->orderBy('title')->get();
    }

    public function render(): View
    {
        $maximum = $this->maximum();
        $total = $this->raffle->priceForQuantity(count($this->selected));

        return view('livewire.ticket-purchase', [
            'numbers' => $this->boardNumbers(),
            'pageCount' => $this->pageCount(),
            'pageLabel' => $this->pageLabel(),
            'minimum' => $this->minimum(),
            'maximum' => $maximum,
            'prices' => array_map($this->formatInRaffleCurrency(...), $this->raffle->priceTable($maximum)),
            'offers' => $this->offers($maximum),
            'total' => $this->formatInRaffleCurrency($total),
            'quotes' => $this->step === 'pay' ? $this->quotes($total) : [],
            'payment' => $this->step === 'done' ? $this->payment() : null,
        ]);
    }

    /**
     * @return array<string, list<mixed>>
     */
    protected function rules(): array
    {
        $personName = ['required', 'string', 'min:2', 'max:60', "regex:/^[\\pL\\s'.\\-]+$/u"];

        return [
            'dni' => ['required', 'string', 'regex:/^\d{6,9}$/'],
            'name' => $personName,
            'lastname' => $personName,
            'phone' => ['required', 'string', function (string $attribute, mixed $value, Closure $fail): void {
                if (Customer::normalizePhone((string) $value) === null) {
                    $fail(__('Enter a valid mobile number, e.g. 0412 1234567.'));
                }
            }],
            'paymentMethodId' => ['required', Rule::in($this->paymentMethods->modelKeys())],
            'reference' => ['required', 'string', 'regex:/^[A-Z0-9\-]{6,30}$/'],
            'proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'dni.required' => __('Enter your ID number.'),
            'dni.regex' => __('Enter your ID with numbers only, e.g. 12345678.'),
            'name.required' => __('Enter your first name.'),
            'name.*' => __('Enter a valid first name.'),
            'lastname.required' => __('Enter your last name.'),
            'lastname.*' => __('Enter a valid last name.'),
            'phone.required' => __('Enter your mobile number.'),
            'paymentMethodId.*' => __('Choose how you paid.'),
            'reference.required' => __('Enter the reference number of your payment.'),
            'reference.regex' => __('The reference needs 6 to 30 letters or numbers.'),
            'proof.required' => __('Attach the capture of your payment.'),
            'proof.max' => __('The capture is too heavy. Try with a smaller image.'),
            'proof.*' => __('Attach an image of your payment (JPG, PNG or WEBP).'),
        ];
    }

    private function cleanInput(): void
    {
        $this->dni = preg_replace('/\D/', '', $this->dni);
        $this->name = Str::title(Str::squish($this->name));
        $this->lastname = Str::title(Str::squish($this->lastname));
        $this->phone = trim($this->phone);
        $this->reference = Str::upper(preg_replace('/\s+/', '', $this->reference));
    }

    /**
     * Drop numbers that are no longer buyable and report why the purchase cannot continue yet.
     */
    private function selectionIsReady(): bool
    {
        if (! $this->raffle->salesStatus()->isOpen()) {
            $this->addError('selected', __('Sales for this raffle are closed.'));

            return false;
        }

        $selected = array_slice($this->validNumbers($this->selected), 0, Raffle::MAX_TICKETS_PER_PURCHASE);
        $taken = $this->raffle->tickets()->whereIn('number', $selected)->orderBy('number')->pluck('number')->all();

        $this->selected = array_values(array_diff($selected, $taken));

        if ($taken !== []) {
            $this->addError('selected', trans_choice(
                '{1} Number :numbers was just taken. Pick another one.|[2,*] Numbers :numbers were just taken. Pick others.',
                count($taken),
                ['numbers' => implode(', ', $taken)],
            ));

            return false;
        }

        if (count($this->selected) < $this->minimum()) {
            $this->addError('selected', trans_choice(
                '{1} Pick at least :count number.|[2,*] Pick at least :count numbers.',
                $this->minimum(),
                ['count' => $this->minimum()],
            ));

            return false;
        }

        return true;
    }

    private function recoverFrom(ReservationFailed $exception): void
    {
        if ($exception->reason === ReservationFailed::DUPLICATE_REFERENCE) {
            $this->addError('reference', __('This reference was already reported. If you think it is a mistake, contact the organizer.'));

            return;
        }

        $this->step = 'pick';

        if ($this->selectionIsReady()) {
            $this->addError('selected', __('We could not reserve your numbers. Please try again.'));
        }
    }

    /**
     * @param  array<mixed>  $numbers
     * @return list<string>
     */
    private function validNumbers(array $numbers): array
    {
        $valid = array_filter($numbers, fn (mixed $number): bool => is_string($number) && $this->raffle->hasNumber($number));

        return array_values(array_unique($valid));
    }

    /**
     * @return list<array{number: string, taken: bool}>
     */
    private function boardNumbers(): array
    {
        $from = $this->page * Raffle::NUMBERS_PER_PAGE;
        $to = min($from + Raffle::NUMBERS_PER_PAGE, $this->raffle->ticket_amount) - 1;
        $taken = array_flip($this->raffle->takenNumbersBetween($from, $to));

        return array_map(function (int $number) use ($taken): array {
            $formatted = $this->raffle->formatNumber($number);

            return ['number' => $formatted, 'taken' => isset($taken[$formatted])];
        }, range($from, $to));
    }

    private function pageCount(): int
    {
        return max(1, (int) ceil($this->raffle->ticket_amount / Raffle::NUMBERS_PER_PAGE));
    }

    private function pageLabel(): string
    {
        $from = $this->page * Raffle::NUMBERS_PER_PAGE;
        $to = min($from + Raffle::NUMBERS_PER_PAGE, $this->raffle->ticket_amount) - 1;

        return $this->raffle->formatNumber($from).' – '.$this->raffle->formatNumber($to);
    }

    private function available(): int
    {
        return $this->availableCount ??= max(0, $this->raffle->ticket_amount - $this->raffle->tickets()->count());
    }

    private function minimum(): int
    {
        return max(1, min($this->raffle->minimum_tickets, $this->available()));
    }

    private function maximum(): int
    {
        return min(Raffle::MAX_TICKETS_PER_PURCHASE, $this->available());
    }

    private function formatInRaffleCurrency(int $amount): string
    {
        return money($amount, $this->raffle->currency)->format();
    }

    /**
     * @return list<array{quantity: int, price: string, saving: string|null}>
     */
    private function offers(int $maximum): array
    {
        return $this->raffle->offers
            ->filter(fn (Offer $offer): bool => $offer->ticket_amount > 1 && $offer->ticket_amount <= $maximum)
            ->sortBy('ticket_amount')
            ->map(function (Offer $offer): array {
                $saving = $offer->ticket_amount * $this->raffle->ticket_price - $offer->price;

                return [
                    'quantity' => (int) $offer->ticket_amount,
                    'price' => $this->formatInRaffleCurrency((int) $offer->price),
                    'saving' => $saving > 0 ? $this->formatInRaffleCurrency($saving) : null,
                ];
            })
            ->values()
            ->all();
    }

    /**
     * What the buyer has to send through each payment method to cover the total.
     *
     * @return array<int, array{amount: string, plain: string, converted: bool, needs_manual_conversion: bool, rate: string|null}>
     */
    private function quotes(int $total): array
    {
        return $this->paymentMethods
            ->mapWithKeys(function (PaymentMethod $method) use ($total): array {
                $quote = $method->quoteFor($total, $this->raffle->currency, $this->rate);

                return [$method->id => [
                    'amount' => money($quote['amount'], $quote['currency'])->format(),
                    'plain' => number_format($quote['amount'] / 100, 2, $quote['currency'] === 'VED' ? ',' : '.', ''),
                    'converted' => $quote['exchange_rate'] !== null,
                    'needs_manual_conversion' => $quote['currency'] !== $method->currency,
                    'rate' => $quote['exchange_rate'] !== null
                        ? money((int) round($quote['exchange_rate'] * 100), 'VED')->format()
                        : null,
                ]];
            })
            ->all();
    }

    private function payment(): ?Payment
    {
        return Payment::query()
            ->withoutGlobalScopes()
            ->with(['tickets' => fn ($query) => $query->orderBy('number'), 'paymentMethod'])
            ->where('raffle_id', $this->raffle->id)
            ->find($this->paymentId);
    }

    private function sessionKey(): string
    {
        return "ticket-purchase.{$this->raffle->id}";
    }
}
