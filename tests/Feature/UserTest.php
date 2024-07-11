<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test Get Users
     */
    public function testGetUsers()
    {
        $user = User::factory()->make();
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * Test Create User
    */
    public function testCreateUser()
    {
        $user = User::factory()->create([
            "role" => "admin"
        ]);
        $this->assertDatabaseHas("users", $user->toArray());
    }

    /**
     * Test Update User
    */
    public function testUpedateUser()
    {
        $user = User::factory()->create([
            "role" => "client"
        ]);

        $user->update([
            "role" => "admin"
        ]);
        $this->assertDatabaseHas("users", $user->toArray());
    }

    /**
     * Test Delete User
    */
    public function testDeleteUser()
    {
        $user = User::factory()->create();
        $user->delete();
        $this->assertDatabaseEmpty($user);
    }
}
