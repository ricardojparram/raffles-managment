<?php

namespace Tests\Feature;

use App\Enums\TeamRole;
use App\Filament\Resources\PaymentResource;
use App\Filament\Resources\PaymentResource\Pages\ListPayments;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PaymentReviewTest extends TestCase
{
    use RefreshDatabase;

    private Team $team;
    private User $admin;
    private Raffle $raffle;
    private PaymentMethod $method;
    private Customer $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::create(['name' => 'Team Alpha']);
        $this->admin = User::factory()->create();
        $this->admin->teams()->attach($this->team, ['role' => TeamRole::ADMIN->value]);

        $this->actingAs($this->admin);
        Filament::setTenant($this->team);

        $this->raffle = Raffle::create([
            'team_id' => $this->team->id,
            'title' => 'Super Moto',
            'description' => 'Gana una moto',
            'date' => now()->addDays(10),
            'ticket_price' => 500,
            'ticket_amount' => 100,
            'status' => 'active',
        ]);

        $this->method = PaymentMethod::create([
            'team_id' => $this->team->id,
            'title' => 'Pago Movil Banesco',
            'description' => json_encode(['banco' => 'Banesco']),
            'currency' => 'USD',
            'icon' => 'heroicon-o-credit-card',
            'is_active' => true,
        ]);

        $this->customer = Customer::create([
            'team_id' => $this->team->id,
            'dni' => '12345678',
            'name' => 'Carlos',
            'lastname' => 'Perez',
            'phone' => '+584121234567',
        ]);
    }

    public function test_admin_can_confirm_payment_via_model_and_records_audit(): void
    {
        $payment = Payment::create([
            'team_id' => $this->team->id,
            'customer_id' => $this->customer->id,
            'raffle_id' => $this->raffle->id,
            'payment_method_id' => $this->method->id,
            'amount' => 500,
            'currency' => 'USD',
            'status' => Payment::PENDING_STATUS,
            'payment_date' => now(),
            'reference' => 'REF123456',
        ]);

        Ticket::create([
            'raffle_id' => $this->raffle->id,
            'customer_id' => $this->customer->id,
            'payment_id' => $payment->id,
            'number' => '07',
        ]);

        $payment->confirm($this->admin);

        $this->assertEquals(Payment::CONFIRMED_STATUS, $payment->status);
        $this->assertEquals($this->admin->id, $payment->reviewed_by);
        $this->assertNotNull($payment->reviewed_at);
        $this->assertCount(1, $payment->tickets()->get());
    }

    public function test_admin_can_reject_payment_and_tickets_are_released(): void
    {
        $payment = Payment::create([
            'team_id' => $this->team->id,
            'customer_id' => $this->customer->id,
            'raffle_id' => $this->raffle->id,
            'payment_method_id' => $this->method->id,
            'amount' => 500,
            'currency' => 'USD',
            'status' => Payment::PENDING_STATUS,
            'payment_date' => now(),
            'reference' => 'REF123456',
        ]);

        Ticket::create([
            'raffle_id' => $this->raffle->id,
            'customer_id' => $this->customer->id,
            'payment_id' => $payment->id,
            'number' => '07',
        ]);

        $payment->reject($this->admin);

        $this->assertEquals(Payment::REJECTED_STATUS, $payment->status);
        $this->assertEquals($this->admin->id, $payment->reviewed_by);
        $this->assertNotNull($payment->reviewed_at);
        $this->assertCount(0, $payment->tickets()->get());
    }

    public function test_filament_actions_confirm_and_reject_payment(): void
    {
        $payment = Payment::create([
            'team_id' => $this->team->id,
            'customer_id' => $this->customer->id,
            'raffle_id' => $this->raffle->id,
            'payment_method_id' => $this->method->id,
            'amount' => 500,
            'currency' => 'USD',
            'status' => Payment::PENDING_STATUS,
            'payment_date' => now(),
            'reference' => 'REF999999',
        ]);

        Ticket::create([
            'raffle_id' => $this->raffle->id,
            'customer_id' => $this->customer->id,
            'payment_id' => $payment->id,
            'number' => '42',
        ]);

        // Call confirm action on table
        Livewire::test(ListPayments::class)
            ->callTableAction('confirm', $payment);

        $payment->refresh();
        $this->assertEquals(Payment::CONFIRMED_STATUS, $payment->status);
        $this->assertEquals($this->admin->id, $payment->reviewed_by);
    }
}
