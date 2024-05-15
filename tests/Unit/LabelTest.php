<?php

namespace Tests\Unit;

use App\Models\Label;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class LabelTest extends TestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setup();
    }

    public function test_label()
    {
        $labels = Label::all();
        $names = $labels->pluck('name')->toArray();
        
        $this->assertEquals(['Архив', '2024', 'Топ'], $names);
    }
}
