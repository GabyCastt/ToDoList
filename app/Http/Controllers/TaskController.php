<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of all tasks.
     */
    public function index()
    {
        $tasks = Task::latest()->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea creada exitosamente!');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed'   => 'sometimes|boolean',
        ]);

        // Normalize the checkbox value
        $validated['completed'] = $request->has('completed');

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea actualizada exitosamente!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', '¡Tarea eliminada exitosamente!');
    }

    /**
     * Toggle the completed status of a task.
     */
    public function toggleComplete(Task $task)
    {
        $task->update(['completed' => !$task->completed]);

        return redirect()->back()
            ->with('success', 'Estado de la tarea actualizado.');
    }
}
