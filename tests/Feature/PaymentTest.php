<?php

namespace Tests\Feature;

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_rejecting_a_payment_releases_its_numbers(): void
    {
        $payment = $this->createPaymentWithTickets(['07', '42']);

        $payment->update(['status' => PaymentStatus::Rejected->value]);

        $this->assertSame(0, Ticket::query()->count());
    }

    public function test_confirming_a_payment_keeps_its_numbers(): void
    {
        $payment = $this->createPaymentWithTickets(['07', '42']);

        $payment->update(['status' => PaymentStatus::Confirmed->value]);

        $this->assertSame(2, Ticket::query()->count());
    }

    public function test_rejecting_a_payment_leaves_other_tickets_alone(): void
    {
        $payment = $this->createPaymentWithTickets(['07']);
        $other = Ticket::factory()->create(['raffle_id' => $payment->raffle_id, 'number' => '99']);

        $payment->update(['status' => PaymentStatus::Rejected->value]);

        $this->assertTrue($other->exists());
    }

    public function test_deleting_a_payment_releases_its_numbers(): void
    {
        $payment = $this->createPaymentWithTickets(['07', '42']);

        $payment->delete();

        $this->assertSame(0, Ticket::query()->count());
    }

    /**
     * @param  list<string>  $numbers
     */
    protected function createPaymentWithTickets(array $numbers): Payment
    {
        $payment = Payment::factory()->create();

        foreach ($numbers as $number) {
            Ticket::factory()->create([
                'raffle_id' => $payment->raffle_id,
                'customer_id' => $payment->customer_id,
                'payment_id' => $payment->id,
                'number' => $number,
            ]);
        }

        return $payment;
    }
}
