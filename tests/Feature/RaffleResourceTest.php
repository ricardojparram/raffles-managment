<?php

namespace Tests\Feature;

use App\Enums\Status;
use App\Filament\Resources\RaffleResource;
use App\Filament\Resources\RaffleResource\Pages\EditRaffle;
use App\Filament\Resources\RaffleResource\Pages\ListRaffles;
use App\Models\Offer;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\Ticket;
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

    public function test_saving_the_form_stores_how_many_tickets_the_raffle_has(): void
    {
        $raffle = $this->createRaffle();

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->fillForm(['ticket_amount' => 1000, 'minimum_tickets' => 2])
            ->call('save')
            ->assertHasNoFormErrors();

        $raffle->refresh();

        $this->assertSame(1000, $raffle->ticket_amount);
        $this->assertSame(2, $raffle->minimum_tickets);
    }

    public function test_a_raffle_needs_at_least_two_tickets(): void
    {
        $raffle = $this->createRaffle();

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->fillForm(['ticket_amount' => 1])
            ->call('save')
            ->assertHasFormErrors(['ticket_amount']);
    }

    public function test_the_minimum_purchase_cannot_exceed_the_tickets_of_the_raffle(): void
    {
        $raffle = $this->createRaffle();

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->fillForm(['ticket_amount' => 10, 'minimum_tickets' => 11])
            ->call('save')
            ->assertHasFormErrors(['minimum_tickets']);
    }

    public function test_the_ticket_count_is_locked_once_numbers_are_taken(): void
    {
        $raffle = $this->createRaffle(['ticket_amount' => 100]);
        Ticket::factory()->create(['raffle_id' => $raffle->id, 'number' => '07']);

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->assertFormFieldDisabled('ticket_amount')
            ->fillForm(['ticket_amount' => 1000])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(100, $raffle->refresh()->ticket_amount);
    }

    public function test_the_ticket_count_can_change_while_nothing_is_sold(): void
    {
        $raffle = $this->createRaffle();

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->assertFormFieldEnabled('ticket_amount');
    }

    public function test_a_new_cover_image_is_stored_on_the_public_disk(): void
    {
        $raffle = $this->createRaffle();

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->fillForm(['img' => [UploadedFile::fake()->image('new-cover.jpg')]])
            ->call('save')
            ->assertHasNoFormErrors();

        $path = $raffle->refresh()->img;

        $this->assertStringStartsWith("tenant-{$this->team->id}/raffles/", $path);
        Storage::disk('public')->assertExists($path);
        Storage::disk('local')->assertMissing($path);
    }

    public function test_cover_images_must_be_raster_files(): void
    {
        $raffle = $this->createRaffle();
        $svg = UploadedFile::fake()->createWithContent('cover.svg', '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>');

        Livewire::test(EditRaffle::class, ['record' => $raffle->getRouteKey()])
            ->fillForm(['img' => [$svg]])
            ->call('save')
            ->assertHasFormErrors(['img']);
    }

    public function test_published_raffles_link_to_their_public_page(): void
    {
        $raffle = $this->createRaffle();

        Livewire::test(ListRaffles::class)
            ->assertTableActionVisible('publicPage', $raffle)
            ->assertTableActionHasUrl('publicPage', $raffle->publicUrl(), $raffle)
            ->assertTableActionVisible('copyPublicLink', $raffle);
    }

    public function test_draft_raffles_have_no_public_page_to_share(): void
    {
        $draft = $this->createRaffle(['status' => Status::Pending->value]);

        Livewire::test(ListRaffles::class)
            ->assertTableActionHidden('publicPage', $draft)
            ->assertTableActionHidden('copyPublicLink', $draft);
    }

    public function test_the_panel_links_to_the_public_page_of_the_organizer(): void
    {
        $this->get(RaffleResource::getUrl('index', panel: 'admin', tenant: $this->team))
            ->assertOk()
            ->assertSee(route('raffles.index', $this->team));
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
