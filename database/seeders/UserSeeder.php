<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnums;
use App\Enums\RolesEnums;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        foreach (RolesEnums::cases() as $roles)
        {
            Role::create(["name" => $roles->value]);
        }

        foreach (PermissionsEnums::cases() as $permissions)
       {
            Permission::create(["name" => $permissions->value]);
       } 

        // Create admin user
        $admin = User::create([
            "name" => "Admin User",
            "email" => "admin@gmail.com",
            "password" => Hash::make("password123"),
            "role" => RolesEnums::ADMIN->value
        ]);

        // Assign admin role
        $admin->assignRole(RolesEnums::ADMIN->value); // Assuming ADMIN() is a method to retrieve the admin role from RolesEnums
    }
}
