<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(3)->create();
/* 
        User::factory()->create([
            'id' => 3,
            'name' => 'Anna',
            'email' => 'anna@mail.ru'
        ]); */
    }
}
