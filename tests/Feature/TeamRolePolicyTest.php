<?php

namespace Tests\Feature;

use App\Enums\TeamRole;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamRolePolicyTest extends TestCase
{
    use RefreshDatabase;

    private Team $teamA;
    private Team $teamB;
    private User $ownerA;
    private User $adminA;
    private User $sellerA;
    private User $viewerA;
    private User $ownerB;

    protected function setUp(): void
    {
        parent::setUp();

        $this->teamA = Team::create(['name' => 'Team Alpha']);
        $this->teamB = Team::create(['name' => 'Team Beta']);

        $this->ownerA = User::factory()->create();
        $this->ownerA->teams()->attach($this->teamA, ['role' => TeamRole::OWNER->value]);

        $this->adminA = User::factory()->create();
        $this->adminA->teams()->attach($this->teamA, ['role' => TeamRole::ADMIN->value]);

        $this->sellerA = User::factory()->create();
        $this->sellerA->teams()->attach($this->teamA, ['role' => TeamRole::SELLER->value]);

        $this->viewerA = User::factory()->create();
        $this->viewerA->teams()->attach($this->teamA, ['role' => TeamRole::VIEWER->value]);

        $this->ownerB = User::factory()->create();
        $this->ownerB->teams()->attach($this->teamB, ['role' => TeamRole::OWNER->value]);
    }

    public function test_owner_can_manage_everything_in_their_team(): void
    {
        $this->actingAs($this->ownerA);
        Filament::setTenant($this->teamA);

        $raffle = Raffle::create([
            'team_id' => $this->teamA->id,
            'title' => 'Rifa Alpha',
            'description' => 'Rifa de prueba',
            'date' => now()->addDays(5),
            'ticket_price' => 100,
            'ticket_amount' => 100,
            'status' => 'active',
        ]);

        $this->assertTrue($this->ownerA->can('viewAny', Raffle::class));
        $this->assertTrue($this->ownerA->can('create', Raffle::class));
        $this->assertTrue($this->ownerA->can('update', $raffle));
        $this->assertTrue($this->ownerA->can('delete', $raffle));

        $this->assertTrue($this->ownerA->can('viewAny', User::class));
        $this->assertTrue($this->ownerA->can('create', User::class));
        $this->assertTrue($this->ownerA->can('update', $this->adminA));
        $this->assertTrue($this->ownerA->can('delete', $this->adminA));
    }

    public function test_admin_cannot_edit_or_delete_owner(): void
    {
        $this->actingAs($this->adminA);
        Filament::setTenant($this->teamA);

        $this->assertTrue($this->adminA->can('viewAny', User::class));
        $this->assertTrue($this->adminA->can('update', $this->sellerA));
        $this->assertTrue($this->adminA->can('delete', $this->sellerA));

        // Admin must NOT be able to update or delete the Owner
        $this->assertFalse($this->adminA->can('update', $this->ownerA));
        $this->assertFalse($this->adminA->can('delete', $this->ownerA));
    }

    public function test_seller_has_restricted_permissions(): void
    {
        $this->actingAs($this->sellerA);
        Filament::setTenant($this->teamA);

        $raffle = Raffle::create([
            'team_id' => $this->teamA->id,
            'title' => 'Rifa Alpha',
            'description' => 'Rifa de prueba',
            'date' => now()->addDays(5),
            'ticket_price' => 100,
            'ticket_amount' => 100,
            'status' => 'active',
        ]);

        // Seller can view raffles but cannot create, edit, or delete them
        $this->assertTrue($this->sellerA->can('viewAny', Raffle::class));
        $this->assertTrue($this->sellerA->can('view', $raffle));
        $this->assertFalse($this->sellerA->can('create', Raffle::class));
        $this->assertFalse($this->sellerA->can('update', $raffle));
        $this->assertFalse($this->sellerA->can('delete', $raffle));

        // Seller cannot manage users or payment methods
        $this->assertFalse($this->sellerA->can('viewAny', User::class));
        $this->assertFalse($this->sellerA->can('viewAny', PaymentMethod::class));
    }

    public function test_viewer_has_read_only_access(): void
    {
        $this->actingAs($this->viewerA);
        Filament::setTenant($this->teamA);

        $raffle = Raffle::create([
            'team_id' => $this->teamA->id,
            'title' => 'Rifa Alpha',
            'description' => 'Rifa de prueba',
            'date' => now()->addDays(5),
            'ticket_price' => 100,
            'ticket_amount' => 100,
            'status' => 'active',
        ]);

        $this->assertTrue($this->viewerA->can('viewAny', Raffle::class));
        $this->assertTrue($this->viewerA->can('view', $raffle));
        $this->assertFalse($this->viewerA->can('create', Raffle::class));
        $this->assertFalse($this->viewerA->can('update', $raffle));
        $this->assertFalse($this->viewerA->can('delete', $raffle));
        $this->assertFalse($this->viewerA->can('create', Payment::class));
        $this->assertFalse($this->viewerA->can('viewAny', User::class));
    }

    public function test_user_cannot_access_or_modify_other_team_resources(): void
    {
        $raffleB = Raffle::create([
            'team_id' => $this->teamB->id,
            'title' => 'Rifa Beta',
            'description' => 'Rifa Beta de prueba',
            'date' => now()->addDays(5),
            'ticket_price' => 100,
            'ticket_amount' => 100,
            'status' => 'active',
        ]);

        // Tenant set to Team A
        $this->actingAs($this->ownerA);
        Filament::setTenant($this->teamA);

        // Owner of Team A cannot view, update, or delete Raffle of Team B
        $this->assertFalse($this->ownerA->can('view', $raffleB));
        $this->assertFalse($this->ownerA->can('update', $raffleB));
        $this->assertFalse($this->ownerA->can('delete', $raffleB));

        // Owner of Team A cannot edit or delete User belonging only to Team B
        $this->assertFalse($this->ownerA->can('view', $this->ownerB));
        $this->assertFalse($this->ownerA->can('update', $this->ownerB));
        $this->assertFalse($this->ownerA->can('delete', $this->ownerB));
    }
}
