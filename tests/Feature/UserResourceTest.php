<?php

namespace Tests\Feature;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Team;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->team = Team::create(['name' => 'Test Team']);
        $this->user->teams()->attach($this->team, ['role' => 'admin']);
        
        // Ensure tenant is set for Filament panel if using tenancy
        $this->actingAs($this->user);
        Filament::setTenant($this->team);
    }

    public function test_can_render_user_resource_page(): void
    {
        $this->get(UserResource::getUrl('index', panel: 'admin', tenant: $this->team))
             ->assertSuccessful();
    }

    public function test_can_render_user_create_page(): void
    {
        $this->get(UserResource::getUrl('create', panel: 'admin', tenant: $this->team))
             ->assertSuccessful();
    }

    public function test_can_create_user(): void
    {
        $userData = User::factory()->make()->toArray();
        $userData['password'] = 'password123';

        Livewire::test(UserResource\Pages\CreateUser::class)
            ->fillForm([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }

    public function test_can_edit_user_without_password(): void
    {
        $user = User::factory()->create();
        $user->teams()->attach($this->team, ['role' => 'seller']);

        Livewire::test(UserResource\Pages\EditUser::class, [
            'record' => $user->getRouteKey(),
        ])
            ->fillForm([
                'name' => 'Updated Name',
                'email' => $user->email,
                // Omit password
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
        ]);
    }
}
