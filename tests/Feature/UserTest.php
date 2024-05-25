<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_example(): void
    {
        $response = $this->get('/user/1');
    
        $response->assertStatus(200);
    }

    public function test_create_new_user()
    {
        $user = User::factory()->create();

        $response = $this->get("/user/{$user->id}");
        
        $response->assertOk();

        $response->assertJsonPath('name', $user->name);
    }

    protected function tearDown(): void
    {
    }
}
