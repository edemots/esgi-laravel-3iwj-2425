<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::query()
            ->with(['reporter', 'assignee', 'labels'])
            ->select(['id', 'title', 'created_at', 'reporter_id', 'assignee_id'])
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
        // $task->reporter_id = Auth::id();
        $task->reporter_id = $request->user()->id;
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
        $task->load(['labels']);
        $labels = Label::query()->select(['id', 'name'])->get();

        return view('task.edit', compact('task', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'min:2', 'max:100'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'labels.*' => ['exists:labels,id'],
        ]);

        $task->update($validated);
        $task->labels()->sync($validated['labels']);

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
