<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::query()
            ->select(['id', 'title', 'created_at'])
            ->latest()
            ->get();

        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['min:2', 'max:100'],
        ]);

        $task = new Task($validated);
        $task->save();

        return redirect()
            ->route('tasks.create')
            ->with('success', 'Tâche créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['min:2', 'max:100'],
        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'La tâche a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tâche supprimée.');
    }
}
