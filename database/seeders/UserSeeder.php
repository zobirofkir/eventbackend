<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnums;
use App\Enums\RolesEnums;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        foreach (RolesEnums::cases() as $role) {
            Role::create([
                'name' => $role->value,
                'guard_name' => 'api' 
            ]);
        }

        // Create permissions
        foreach (PermissionsEnums::cases() as $permission) {
            Permission::create([
                'name' => $permission->value,
                'guard_name' => 'api' 
            ]);
        }

        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => RolesEnums::ADMIN->value
        ]);

        $admin->assignRole(RolesEnums::ADMIN->value); 
    }
}
