<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; // Import the TaskController

// Route for displaying the list of tasks
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// Route for storing a new task
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Route for editing a specific task
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

// Route for updating a specific task
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

// Route for deleting a specific task
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
