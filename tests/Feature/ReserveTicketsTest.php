<?php

namespace Tests\Feature;

use App\Actions\ReserveTickets;
use App\Enums\PaymentStatus;
use App\Exceptions\ReservationFailed;
use App\Models\Customer;
use App\Models\Offer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReserveTicketsTest extends TestCase
{
    use RefreshDatabase;

    protected Team $team;

    protected Raffle $raffle;

    protected PaymentMethod $zelle;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

        $this->team = Team::factory()->create();
        $this->raffle = Raffle::factory()->create(['team_id' => $this->team->id, 'ticket_price' => 1000]);
        $this->zelle = PaymentMethod::factory()->create(['team_id' => $this->team->id]);
    }

    public function test_it_reserves_the_numbers_under_a_pending_payment(): void
    {
        $payment = $this->reserve(numbers: ['07', '42']);

        $this->assertSame(PaymentStatus::Pending->value, $payment->status);
        $this->assertSame($this->team->id, $payment->team_id);
        $this->assertSame($this->raffle->id, $payment->raffle_id);
        $this->assertSame($this->zelle->id, $payment->payment_method_id);
        $this->assertSame('ABC12345', $payment->reference);
        $this->assertSame(2000, $payment->amount);
        $this->assertSame('USD', $payment->currency);
        $this->assertNull($payment->exchange_rate);
        $this->assertEqualsCanonicalizing(['07', '42'], $payment->tickets()->pluck('number')->all());
        $this->assertSame(
            [$this->raffle->id],
            $payment->tickets()->pluck('raffle_id')->unique()->values()->all(),
        );
    }

    public function test_it_creates_the_buyer_as_a_customer_of_the_team(): void
    {
        $payment = $this->reserve();

        $customer = $payment->customer;

        $this->assertSame($this->team->id, $customer->team_id);
        $this->assertSame('12345678', $customer->dni);
        $this->assertSame('María', $customer->name);
        $this->assertSame('Pérez', $customer->lastname);
        $this->assertSame('+584121234567', $customer->phone);
        $this->assertSame($customer->id, $payment->tickets()->first()->customer_id);
    }

    public function test_it_reuses_an_existing_customer_without_overwriting_their_data(): void
    {
        $existing = Customer::factory()->create([
            'team_id' => $this->team->id,
            'dni' => '12345678',
            'name' => 'Original',
            'phone' => '+584140000000',
        ]);

        $payment = $this->reserve();

        $this->assertSame($existing->id, $payment->customer_id);
        $this->assertSame('Original', $existing->refresh()->name);
        $this->assertSame('+584140000000', $existing->phone);
        $this->assertSame(1, Customer::query()->count());
    }

    public function test_customers_with_the_same_id_card_in_another_team_are_not_reused(): void
    {
        $other = Customer::factory()->create(['team_id' => Team::factory()->create()->id, 'dni' => '12345678']);

        $payment = $this->reserve();

        $this->assertNotSame($other->id, $payment->customer_id);
    }

    public function test_it_charges_the_offer_price_when_one_applies(): void
    {
        Offer::factory()->create(['raffle_id' => $this->raffle->id, 'ticket_amount' => 3, 'price' => 2500]);

        $payment = $this->reserve(numbers: ['01', '02', '03']);

        $this->assertSame(2500, $payment->amount);
    }

    public function test_it_converts_the_amount_for_a_method_in_another_currency(): void
    {
        $pagoMovil = PaymentMethod::factory()->bolivars()->create(['team_id' => $this->team->id]);

        $payment = $this->reserve(numbers: ['01', '02'], method: $pagoMovil, usdToVedRate: 800.0);

        $this->assertSame(1600000, $payment->amount);
        $this->assertSame('VED', $payment->currency);
        $this->assertEquals(800.0, $payment->exchange_rate);
    }

    public function test_it_stores_the_proof_on_the_private_disk(): void
    {
        $payment = $this->reserve();

        $this->assertStringStartsWith("tenant-{$this->team->id}/payments/", $payment->img);
        Storage::disk('local')->assertExists($payment->img);
    }

    public function test_it_refuses_numbers_that_are_already_taken(): void
    {
        Ticket::factory()->create(['raffle_id' => $this->raffle->id, 'number' => '07']);

        try {
            $this->reserve(numbers: ['07', '42']);
            $this->fail('The reservation should have failed.');
        } catch (ReservationFailed $exception) {
            $this->assertSame(ReservationFailed::NUMBERS_TAKEN, $exception->reason);
            $this->assertSame(['07'], $exception->numbers);
        }

        $this->assertSame(0, Payment::query()->count());
        $this->assertDatabaseMissing('customers', ['dni' => '12345678']);
        $this->assertSame(1, Ticket::query()->count());
        $this->assertSame([], Storage::disk('local')->allFiles());
    }

    public function test_it_refuses_a_raffle_that_is_not_on_sale(): void
    {
        $this->raffle->forceFill(['date' => now()->subMinute()])->save();

        $this->assertReservationFails(ReservationFailed::RAFFLE_CLOSED, fn () => $this->reserve());
    }

    public function test_it_refuses_numbers_outside_the_raffle(): void
    {
        $this->assertReservationFails(ReservationFailed::INVALID_SELECTION, fn () => $this->reserve(numbers: ['100']));
        $this->assertReservationFails(ReservationFailed::INVALID_SELECTION, fn () => $this->reserve(numbers: ['7']));
    }

    public function test_it_refuses_an_empty_or_repeated_selection(): void
    {
        $this->assertReservationFails(ReservationFailed::INVALID_SELECTION, fn () => $this->reserve(numbers: []));
        $this->assertReservationFails(ReservationFailed::INVALID_SELECTION, fn () => $this->reserve(numbers: ['07', '07']));
    }

    public function test_it_enforces_the_minimum_tickets_of_the_raffle(): void
    {
        $this->raffle->update(['minimum_tickets' => 3]);

        $this->assertReservationFails(ReservationFailed::INVALID_SELECTION, fn () => $this->reserve(numbers: ['01', '02']));
    }

    public function test_the_minimum_relaxes_when_fewer_numbers_are_left(): void
    {
        $this->raffle->update(['minimum_tickets' => 3, 'ticket_amount' => 10]);
        foreach (['00', '01', '02', '03', '04', '05', '06', '07'] as $number) {
            Ticket::factory()->create(['raffle_id' => $this->raffle->id, 'number' => $number]);
        }

        $payment = $this->reserve(numbers: ['08', '09']);

        $this->assertSame(2, $payment->tickets()->count());
    }

    public function test_it_caps_the_tickets_per_purchase(): void
    {
        $this->raffle->update(['ticket_amount' => 1000]);
        $numbers = array_map(fn (int $number): string => $this->raffle->formatNumber($number), range(0, Raffle::MAX_TICKETS_PER_PURCHASE));

        $this->assertReservationFails(ReservationFailed::INVALID_SELECTION, fn () => $this->reserve(numbers: $numbers));
    }

    public function test_it_refuses_a_payment_method_from_another_team(): void
    {
        $foreign = PaymentMethod::factory()->create();

        $this->assertReservationFails(ReservationFailed::INVALID_SELECTION, fn () => $this->reserve(method: $foreign));
    }

    public function test_it_refuses_a_reference_already_reported_for_the_same_method(): void
    {
        $this->reserve(numbers: ['01'], reference: 'ABC12345');

        $this->assertReservationFails(
            ReservationFailed::DUPLICATE_REFERENCE,
            fn () => $this->reserve(numbers: ['02'], reference: 'ABC12345', dni: '87654321'),
        );
    }

    public function test_a_reference_can_be_reported_again_after_the_first_payment_was_rejected(): void
    {
        $this->reserve(numbers: ['01'], reference: 'ABC12345')->update(['status' => PaymentStatus::Rejected->value]);

        $payment = $this->reserve(numbers: ['02'], reference: 'ABC12345');

        $this->assertSame(PaymentStatus::Pending->value, $payment->status);
    }

    public function test_the_same_reference_is_fine_on_a_different_method(): void
    {
        $other = PaymentMethod::factory()->create(['team_id' => $this->team->id]);
        $this->reserve(numbers: ['01'], reference: 'ABC12345');

        $payment = $this->reserve(numbers: ['02'], reference: 'ABC12345', method: $other);

        $this->assertSame($other->id, $payment->payment_method_id);
    }

    /**
     * @param  list<string>  $numbers
     */
    protected function reserve(
        array $numbers = ['07'],
        ?PaymentMethod $method = null,
        string $reference = 'ABC12345',
        string $dni = '12345678',
        ?float $usdToVedRate = null,
    ): Payment {
        return app(ReserveTickets::class)->handle(
            raffle: $this->raffle->fresh(),
            buyer: ['dni' => $dni, 'name' => 'María', 'lastname' => 'Pérez', 'phone' => '+584121234567'],
            numbers: $numbers,
            paymentMethod: $method ?? $this->zelle,
            reference: $reference,
            proof: UploadedFile::fake()->image('capture.jpg'),
            usdToVedRate: $usdToVedRate,
        );
    }

    protected function assertReservationFails(string $reason, callable $callback): void
    {
        try {
            $callback();
        } catch (ReservationFailed $exception) {
            $this->assertSame($reason, $exception->reason);

            return;
        }

        $this->fail("The reservation should have failed with [{$reason}].");
    }
}
