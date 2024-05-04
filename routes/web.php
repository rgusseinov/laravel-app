<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProfileController, PageController, TaskController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
});

Route::get('about', [PageController::class, 'about']);
Route::get('team', [PageController::class, 'team']);

Route::get('tasks/{id}', [TaskController::class, 'show'])
    ->name('tasks.show');

Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])
    ->name('tasks.edit');

Route::patch('tasks/{id}', [TaskController::class, 'update'])
    ->name('tasks.update');

Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');

// Tasks

Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('task_statuses', [TaskController::class, 'statuses'])->name('task.statuses');
Route::get('labels', [TaskController::class, 'labels'])->name('task.labels');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
