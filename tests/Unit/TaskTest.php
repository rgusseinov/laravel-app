<?php

namespace Tests\Unit;

use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tests\CreatesApplication;

use function PHPUnit\Framework\returnSelf;

class TaskTest extends TestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_task()
    {
        $task = Task::first();

        $this->assertArrayHasKey('name', $task);
        $this->assertArrayHasKey('status_id', $task);
        $this->assertArrayHasKey('author_id', $task);
        $this->assertArrayHasKey('executor_id', $task);
    }

/*     public function test_create_task()
    {
        // $mockTaskController = $this->createMock(TaskController::class);
        // $dataValidate = $mock->store(new Request());

        // 1. Validate function

        // 2. New task
        $data = [];
        $data['status_id'] = 1;
        $data['author_id'] = 1;
        $data['executor_id'] = 1;
        $data['description'] = 'Task description';

        $mockTask = $this->createMock(Task::class);
        $mockTask->expects($this->once())
                 ->method('fill')
                 ->with($data);

        $mockTask->expects($this->once())->method('save');

        // 3. updateLabels

        // 5. redirect
        
    } */


/*     public function test_create_task()
    {
        // Arrange: Create a mock for the Task model
        $mockTask = $this->createMock(Task::class);

        $data = [];
        $data['status_id'] = 1;
        $data['author_id'] = 1;
        $data['executor_id'] = 1;
        $data['description'] = 'Task description';

        $mockTask->expects($this->once())
                 ->method('fill')
                 ->with($data)
                 ->willReturnSelf(); // Return the mock itself after filling
        
        $mockTask->fill($data);
    
        $mockTask->expects($this->once())
                 ->method('save');
        
        $mockTask->save();
    
        // Replace the actual Task model with the mock
        $this->app->instance(Task::class, $mockTask);
    
        // Create a request with necessary data
        $request = new Request([
            'name' => 'Sample Task',
            'status_id' => 1,
            'author_id' => 1,
            'executor_id' => 2,
            'description' => 'Task description',
        ]);
    
        $mockTaskController = $this->createMock(TaskController::class);
        $response = $mockTaskController->store($request);

        $response = $this->post(route('tasks.store'), [
            'name' => 'New task 2',
            'author_id' => 1, 
            'status_id' => 1,
            'executor_id' => 1,
        ]);

        
        $response->assertRedirect(route('tasks.index'));
    } */

}
