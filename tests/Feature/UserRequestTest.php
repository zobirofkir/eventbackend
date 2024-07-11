<?php

namespace Tests\Feature;

use App\Models\User;
use App\Enums\RolesEnums; // Assuming RolesEnums is defined in App\Enums namespace
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role; // Assuming Role is the correct model for roles
use Tests\TestCase;

class UserRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        
        $adminRole = Role::where('name', 'admin')->where('guard_name', 'api')->first();
        if (!$adminRole) {
            $adminRole = Role::create([
                'name' => 'admin',
                'guard_name' => 'api'
            ]);
        }
        
        $user->assignRole($adminRole);
        
        Passport::actingAs($user);
    }

    /**
     * Test Get Users
     */
    public function testGetUsers()
    {
        $this->authenticate();

        $response = $this->get("api/users");
        $response->assertStatus(200);
    }

    /**
     * Test Create User
    */
    public function testCreateUser()
    {
        $this->authenticate();
        $postForm = [
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => "Hello World",
            "image" => "this is the image",
            "phone" => "+212 666666",
            "role" => "admin"
        ];
        $response = $this->post("api/users", $postForm);
        $response->assertStatus(201);
    }

    /**
     * Test Show User
    */
    public function testShowUser()
    {
        $this->authenticate();
        $user = User::factory()->create();
        $response = $this->get("api/users/$user->id");
        $response->assertStatus(200);
    }

    /**
     * Test Update User
    */
    public function testUpdateUser()
    {
        $this->authenticate();
        $user = User::factory()->create();
        $updateUser = [
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => "Hello World",
            "image" => "this is the image",
            "phone" => "+212 666666",
            "role" => "admin"
        ];

        $response = $this->put("api/users/$user->id", $updateUser);
        $response->assertStatus(200);
    }

    /**
     * Test Delete User 
    */
    public function testDeleteUser()
    {
        $this->authenticate();
        $user = User::factory()->create();
        $response = $this->delete("api/users/$user->id");
        $response->assertStatus(200);
    }
}
