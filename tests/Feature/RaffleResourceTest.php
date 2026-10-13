<?php

namespace Tests\Feature;

use App\Filament\Resources\RaffleResource\Pages\EditRaffle;
use App\Models\Offer;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class RaffleResourceTest extends TestCase
{
    use RefreshDatabase;

    protected Team $team;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        Storage::fake('local');

        $this->team = Team::factory()->create();
        $user = User::factory()->create();
        $user->teams()->attach($this->team, ['role' => 'admin']);

        $this->actingAs($user);
        Filament::setTenant($this->team);
    }

    public function test_edit_form_shows_the_ticket_price_in_major_units(): void
    {
        $raffle = $this->createRaffle(['ticket_price' => 1050]);

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->assertSchemaStateSet(['ticket_price' => '10.50']);
    }

    public function test_saving_the_form_stores_the_ticket_price_in_cents(): void
    {
        $raffle = $this->createRaffle(['ticket_price' => 1000]);

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->fillForm(['ticket_price' => '12.50'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(1250, $raffle->refresh()->ticket_price);
    }

    public function test_saving_the_form_stores_offer_prices_in_cents(): void
    {
        $raffle = $this->createRaffle();
        $offer = Offer::factory()->create(['raffle_id' => $raffle->id, 'ticket_amount' => 3, 'price' => 2500]);

        $component = Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()]);

        $this->assertSame('25.00', collect($component->get('data.offers'))->first()['price']);

        $component->call('save')->assertHasNoFormErrors();

        $this->assertSame(2500, $offer->refresh()->price);
    }

    public function test_ticket_price_must_be_numeric(): void
    {
        $raffle = $this->createRaffle();

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->fillForm(['ticket_price' => 'abc'])
            ->call('save')
            ->assertHasFormErrors(['ticket_price']);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function createRaffle(array $attributes = []): Raffle
    {
        $image = UploadedFile::fake()->image('raffle.jpg')->store('raffles', 'public');
        Storage::disk('local')->put($image, Storage::disk('public')->get($image));

        return Raffle::factory()->create([
            'team_id' => $this->team->id,
            'img' => $image,
            ...$attributes,
        ]);
    }
}
