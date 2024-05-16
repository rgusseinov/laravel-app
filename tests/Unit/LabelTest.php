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
        // Model::all() ходит в базу, в юнитах так не принято делать
        // Когда пишем юнит-тесты, нужно мокать все зависимости и тестировать только функционал метода/функции
        // в противном случае, это нельзя назвать юнитами
        // Посмотри, как другие разработчики пишут https://github.com/laravel/framework/tree/11.x/tests
        $labels = Label::all();
        $names = $labels->pluck('name')->toArray();
        
        $this->assertEquals(['Архив', '2024', 'Топ'], $names);
    }
}
