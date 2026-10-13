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
        
        \Spatie\Permission\Models\Role::create(['name' => 'admin', 'team_id' => null])
            ->syncPermissions([
                \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'ViewAny:User']),
                \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'View:User']),
                \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'Create:User']),
                \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'Update:User']),
                \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'Delete:User']),
            ]);
        
        // Asignar el rol de spatie
        setPermissionsTeamId($this->team->id);
        $this->user->assignRole('admin');
        
        // Subscribe the team so feature limits work
        $plan = \Revoltify\Subscriptionify\Models\Plan::create([
            'name' => 'Pro Plan',
            'slug' => 'pro',
            'price' => 10.00,
            'signup_fee' => 0.00,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'is_active' => true,
        ]);
        $plan->features()->create([
            'name' => 'Team Members',
            'slug' => 'team_members',
            'type' => 'limit',
            'value' => '10',
            'resettable_period' => 1,
            'resettable_interval' => 'month',
        ]);
        $this->team->subscribe($plan);
        
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

        Livewire::test(UserResource\Pages\CreateUser::class, [
            'tenant' => $this->team->slug,
        ])
            ->fillForm([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'team_role' => 'admin',
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

        Livewire::test(UserResource\Pages\EditUser::class, [
            'tenant' => $this->team->slug,
            'record' => $user->getRouteKey(),
        ])
            ->fillForm([
                'name' => 'Updated Name',
                'email' => $user->email,
                'team_role' => 'admin',
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
