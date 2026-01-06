<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::query()
            ->select(['id', 'name', 'color'])
            ->withCount(['tasks'])
            ->get();

        return view('label.index', compact('labels'));
    }

    public function create()
    {
        return view('label.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
        ]);

        $label = new Label($data);
        $label->save();

        return redirect()
            ->route('labels.index')
            ->with('success', 'Label créé avec succès');
    }

    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
        ]);

        $label->update($data);

        return redirect()
            ->route('labels.index')
            ->with('succes', 'Label modifié avec succès');
    }

    public function destroy(Label $label)
    {
        $label->delete();

        return redirect()
            ->route('labels.index')
            ->with('success', 'Label supprimé.');
    }
}
