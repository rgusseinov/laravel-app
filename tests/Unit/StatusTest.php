<?php

namespace Tests\Unit;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class StatusTest extends TestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_status()
    {
        $statuses = TaskStatus::all();
        $names = $statuses->pluck('name')->toArray();
        
        $this->assertEquals(['В процессе', 'Архив', 'Выполнено'], $names);
    }
}