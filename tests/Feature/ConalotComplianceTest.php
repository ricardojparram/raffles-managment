<?php

namespace Tests\Feature;

use App\Enums\Status;
use App\Enums\TeamRole;
use App\Filament\Pages\Tenancy\EditTeamProfile;
use App\Models\Raffle;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ConalotComplianceTest extends TestCase
{
    use RefreshDatabase;

    private Team $team;
    private User $owner;
    private Raffle $raffle;

    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::create([
            'name' => 'Organización Oficial',
            'runlot_number' => 'RUNLOT-2026-9999',
        ]);

        $this->owner = User::factory()->create();
        $this->owner->teams()->attach($this->team, ['role' => TeamRole::OWNER->value]);

        $this->raffle = Raffle::create([
            'team_id' => $this->team->id,
            'title' => 'Rifa Benéfica Legal',
            'description' => 'Sorteo auditado',
            'date' => now()->addDays(10),
            'ticket_price' => 200,
            'ticket_amount' => 100,
            'status' => Status::Active->value,
            'conalot_permit' => 'CONALOT-AUT-001',
        ]);
    }

    public function test_public_team_page_displays_runlot_number_and_legal_footer(): void
    {
        $response = $this->get(route('raffles.index', $this->team));

        $response->assertOk()
            ->assertSee('RUNLOT-2026-9999')
            ->assertSee('Prohibida la venta a menores de 18 años');
    }

    public function test_public_raffle_page_displays_conalot_permit(): void
    {
        $response = $this->get(route('raffles.show', ['team' => $this->team, 'raffle' => $this->raffle]));

        $response->assertOk()
            ->assertSee('CONALOT-AUT-001')
            ->assertSee('Autorización CONALOT')
            ->assertSee('Prohibida la venta a menores de 18 años');
    }

    public function test_tenant_profile_page_can_update_runlot_number(): void
    {
        $this->actingAs($this->owner);
        Filament::setTenant($this->team);

        Livewire::test(EditTeamProfile::class)
            ->assertFormSet([
                'name' => 'Organización Oficial',
                'runlot_number' => 'RUNLOT-2026-9999',
            ])
            ->fillForm([
                'name' => 'Organización Modificada',
                'runlot_number' => 'RUNLOT-2026-8888',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->team->refresh();
        $this->assertSame('Organización Modificada', $this->team->name);
        $this->assertSame('RUNLOT-2026-8888', $this->team->runlot_number);
    }

    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Plataforma de Rifas Digitales')
            ->assertSee('Tablero en Tiempo Real')
            ->assertSee('Multimoneda y Tasa BCV')
            ->assertSee('Auditoría de Pagos')
            ->assertSee('Marco Normativo y RUNLOT');
    }
}
