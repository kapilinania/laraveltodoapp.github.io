<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display all tasks
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Store a new task
    public function store(Request $request)
    {
        // Validate the task 
        $request->validate([
            'task_name' => 'required|string|max:255|unique:tasks,task_name',
        ]);

        // Create the task 
        Task::create([
            'task_name' => $request->task_name,
            'status' => 'Pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }


    // Show the edit form 
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Update an existing task
    public function update(Request $request, Task $task)
    {
        // Validate input
        $request->validate([
            'task_name' => 'required|string|max:255',
            'status' => 'required|in:Pending,In-Progress,Completed',
        ]);

        // Update task details
        $task->update([
            'task_name' => $request->task_name,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
