<?php

namespace Tests\Feature;

use App\Enums\TeamRole;
use App\Filament\Resources\RaffleResource\Pages\ListRaffles;
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

class AdminManualSaleTest extends TestCase
{
    use RefreshDatabase;

    private Team $team;
    private User $admin;
    private User $seller;
    private User $viewer;
    private Raffle $raffle;
    private PaymentMethod $method;
    private Customer $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::create(['name' => 'Team Alpha']);

        $this->admin = User::factory()->create();
        $this->admin->teams()->attach($this->team, ['role' => TeamRole::ADMIN->value]);

        $this->seller = User::factory()->create();
        $this->seller->teams()->attach($this->team, ['role' => TeamRole::SELLER->value]);

        $this->viewer = User::factory()->create();
        $this->viewer->teams()->attach($this->team, ['role' => TeamRole::VIEWER->value]);

        $this->actingAs($this->admin);
        Filament::setTenant($this->team);

        $this->raffle = Raffle::create([
            'team_id' => $this->team->id,
            'title' => 'Moto 0km',
            'description' => 'Gran sorteo de moto',
            'date' => now()->addDays(5),
            'ticket_price' => 500, // $5.00
            'ticket_amount' => 100,
            'status' => 'active',
        ]);

        $this->method = PaymentMethod::create([
            'team_id' => $this->team->id,
            'title' => 'Efectivo',
            'description' => json_encode(['info' => 'Caja mostrador']),
            'currency' => 'USD',
            'icon' => 'heroicon-o-banknotes',
            'is_active' => true,
        ]);

        $this->customer = Customer::create([
            'team_id' => $this->team->id,
            'dni' => '12345678',
            'name' => 'Pedro',
            'lastname' => 'Perez',
            'phone' => '+584121112233',
        ]);
    }

    public function test_admin_can_register_manual_sale_with_random_numbers(): void
    {
        Livewire::test(ListRaffles::class)
            ->callTableAction('registerSale', $this->raffle, data: [
                'customer_id' => $this->customer->id,
                'payment_method_id' => $this->method->id,
                'quantity' => 3,
                'amount' => 1500,
                'reference' => 'Efectivo mostrador',
            ])
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseHas('payments', [
            'team_id' => $this->team->id,
            'raffle_id' => $this->raffle->id,
            'customer_id' => $this->customer->id,
            'amount' => 1500,
            'status' => Payment::CONFIRMED_STATUS,
            'reviewed_by' => $this->admin->id,
        ]);

        $payment = Payment::first();
        $this->assertCount(3, $payment->tickets);

        foreach ($payment->tickets as $ticket) {
            $this->assertEquals($this->customer->id, $ticket->customer_id);
            $this->assertEquals($this->raffle->id, $ticket->raffle_id);
            $this->assertTrue($this->raffle->hasNumber($ticket->number));
        }
    }

    public function test_seller_can_also_register_sale(): void
    {
        $this->actingAs($this->seller);
        Filament::setTenant($this->team);

        Livewire::test(ListRaffles::class)
            ->callTableAction('registerSale', $this->raffle, data: [
                'customer_id' => $this->customer->id,
                'payment_method_id' => $this->method->id,
                'quantity' => 2,
                'amount' => 1000,
                'reference' => 'Venta taquilla vendedor',
            ])
            ->assertHasNoTableActionErrors();

        $this->assertDatabaseHas('payments', [
            'reviewed_by' => $this->seller->id,
            'status' => Payment::CONFIRMED_STATUS,
        ]);
    }

    public function test_viewer_cannot_see_register_sale_action(): void
    {
        $this->actingAs($this->viewer);
        Filament::setTenant($this->team);

        Livewire::test(ListRaffles::class)
            ->assertTableActionHidden('registerSale', $this->raffle);
    }

    public function test_cannot_register_sale_when_raffle_is_finished(): void
    {
        $this->raffle->update(['status' => 'finished']);

        Livewire::test(ListRaffles::class)
            ->assertTableActionHidden('registerSale', $this->raffle);
    }
}
