<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to tasks index
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Resource routes for tasks (index, create, store, show, edit, update, destroy)
Route::resource('tasks', TaskController::class);

// Custom route to toggle task completion
Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])
    ->name('tasks.toggle');
