<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_index(): void
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);

        $response->assertViewIs('tasks.index');
        
        $response->assertViewHas('tasks');
    }

    public function test_show(): void
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.show', ['id' => $task->id]));

        $response->assertOk();

        $response->assertViewHas('task');

        $response->assertViewHas('labelsData');

        $response->assertSee($task->name);
    }

    public function test_show_method_will_handle_non_existing_task(): void
    {
        $response = $this->get(route('tasks.show', ['id' => 9999]));

        $response->assertStatus(404);
    }

    public function test_create_task(): void
    {
        $task = new Task();

        $users = User::pluck('name', 'id');
        $statuses = TaskStatus::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('tasks/create');   

        $response->assertStatus(200);

        $response->assertViewIs('tasks.create');

        $response->assertViewHas('task', $task);

        // $response->assertViewHas('users', $users); ??

        $response->assertViewHas('statuses', $statuses);
        
        $response->assertViewHas('labels', $labels);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $userResponse = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        
        $this->assertAuthenticated();

        $userResponse->assertRedirect(route('dashboard'));

        $taskData = [];

        $taskData['name'] = fake()->sentence(3);
        $taskData['status_id'] = $taskStatus->id;
        $taskData['author_id'] = $user->id;
        $taskData['executor_id'] = $user->id;
        $taskData['description'] = fake()->text(10);

        $dataResponse = $this->post(route('tasks.store'), $taskData);

        $dataResponse->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $taskData);
    }
}
