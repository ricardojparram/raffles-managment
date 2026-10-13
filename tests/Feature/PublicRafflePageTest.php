<?php

namespace Tests\Feature;

use App\Livewire\TicketChecker;
use App\Livewire\TicketPurchase;
use App\Models\Offer;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use App\Models\RafflePrize;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PublicRafflePageTest extends TestCase
{
    use RefreshDatabase;

    protected Team $team;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake(['*' => Http::response(['promedio' => 800.0])]);

        $this->team = Team::factory()->create(['name' => 'Rifas El Chamo']);
    }

    public function test_public_url_uses_team_and_raffle_slugs(): void
    {
        $raffle = $this->createRaffle(['title' => 'Moto Nueva']);

        $this->assertSame(url('/r/rifas-el-chamo/moto-nueva'), $raffle->publicUrl());
    }

    public function test_it_shows_a_raffle_that_is_on_sale(): void
    {
        $raffle = $this->createRaffle(['title' => 'Fortuner 2012', 'ticket_price' => 1000]);
        RafflePrize::factory()->create(['raffle_id' => $raffle->id, 'title' => 'Premio anticipado']);
        Offer::factory()->create(['raffle_id' => $raffle->id, 'ticket_amount' => 3, 'price' => 2500]);

        $this->get($raffle->publicUrl())
            ->assertOk()
            ->assertSee('Fortuner 2012')
            ->assertSee('Rifas El Chamo')
            ->assertSee('$10.00')
            ->assertSee('Premio anticipado')
            ->assertSeeLivewire(TicketPurchase::class)
            ->assertSeeLivewire(TicketChecker::class);
    }

    public function test_a_draft_raffle_is_not_found(): void
    {
        $raffle = Raffle::factory()->pending()->create(['team_id' => $this->team->id]);

        $this->get($raffle->publicUrl())->assertNotFound();
    }

    public function test_a_raffle_is_not_reachable_through_another_organizer(): void
    {
        $raffle = $this->createRaffle();
        $other = Team::factory()->create();

        $this->get("/r/{$other->slug}/{$raffle->slug}")->assertNotFound();
    }

    public function test_an_unknown_raffle_is_not_found(): void
    {
        $this->get('/r/rifas-el-chamo/nothing-here')->assertNotFound();
    }

    public function test_a_finished_raffle_stays_visible_without_the_purchase_flow(): void
    {
        $raffle = Raffle::factory()->finished()->create(['team_id' => $this->team->id]);

        $this->get($raffle->publicUrl())
            ->assertOk()
            ->assertSee(__('This raffle has already been drawn.'))
            ->assertDontSeeLivewire(TicketPurchase::class)
            ->assertSeeLivewire(TicketChecker::class);
    }

    public function test_sales_are_closed_after_the_draw_date(): void
    {
        $raffle = Raffle::factory()->drawn()->create(['team_id' => $this->team->id]);

        $this->get($raffle->publicUrl())
            ->assertOk()
            ->assertSee(__('Sales closed when the draw started.'))
            ->assertDontSeeLivewire(TicketPurchase::class);
    }

    public function test_the_description_is_sanitized_before_rendering(): void
    {
        $raffle = $this->createRaffle([
            'description' => '<p>Gran premio</p><script>alert("xss")</script><img src=x onerror="alert(1)">',
        ]);

        $this->get($raffle->publicUrl())
            ->assertOk()
            ->assertSee('<p>Gran premio</p>', false)
            ->assertDontSee('alert("xss")', false)
            ->assertDontSee('onerror', false);
    }

    public function test_it_exposes_share_metadata_for_link_previews(): void
    {
        $raffle = $this->createRaffle(['title' => 'Fortuner 2012', 'img' => 'tenant-1/raffles/cover.jpg']);

        $this->get($raffle->publicUrl())
            ->assertOk()
            ->assertSee('<meta property="og:title" content="Fortuner 2012', false)
            ->assertSee('<meta property="og:image" content="'.$raffle->imageUrl().'"', false)
            ->assertSee('<meta property="og:url" content="'.$raffle->publicUrl().'"', false);
    }

    public function test_it_shows_how_the_organizer_can_be_paid(): void
    {
        $raffle = $this->createRaffle();
        PaymentMethod::factory()->bolivars()->create(['team_id' => $this->team->id]);
        PaymentMethod::factory()->create(['title' => 'Metodo Ajeno']);

        $this->get($raffle->publicUrl())
            ->assertOk()
            ->assertSee('Pago Móvil')
            ->assertDontSee('Metodo Ajeno');
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function createRaffle(array $attributes = []): Raffle
    {
        return Raffle::factory()->create(['team_id' => $this->team->id, ...$attributes]);
    }
}
