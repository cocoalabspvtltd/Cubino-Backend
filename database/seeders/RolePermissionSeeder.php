<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $agent = Role::firstOrCreate(['name' => 'agent']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Create Permissions
        $permissions = [
            'manage bookings',
            'view earnings',
            'edit profile'
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Assign Permissions to Roles
        $admin->givePermissionTo(['manage bookings', 'view earnings', 'edit profile']);
        $agent->givePermissionTo(['view earnings', 'edit profile']);
        $user->givePermissionTo(['edit profile']);

        $user = User::find(1); // Example user
        $user->assignRole('admin');
    }
}
