<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_example(): void
    {
        // Для каждого теста нужно готовить свой state в setUp или в самом тесте
        // https://laravel.com/docs/11.x/database-testing#model-factories
        // https://laravel.com/docs/11.x/database-testing#running-seeders
        $response = $this->get('/user/1');
    
        $response->assertStatus(200);
    }

    public function test_create_new_user()
    {
        $userId = 2;

        $user = User::factory()->create([
            'id' => $userId,
            'name' => 'Adil'
        ]);
        
        $response = $this->get("/user/{$userId}");
        
        $response->assertOk();

        $response->assertJsonPath('name', $user->name);
    }

    protected function tearDown(): void
    {
        // User::where('id', '=', 1)->delete();
    }
}
