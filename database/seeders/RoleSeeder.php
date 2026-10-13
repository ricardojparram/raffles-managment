<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed global roles (team_id = NULL).
     *
     * These are the application-wide role definitions managed by the superadmin.
     * Tenant admins can assign these roles to their users, but cannot create new ones.
     */
    public function run(): void
    {
        $roles = [
            'super_admin',
            'admin',
            'manager',
            'seller',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => 'web', 'team_id' => null],
            );
        }
    }
}
