<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->projects()->create($validated);

        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso!');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Projeto arquivado com sucesso!');
    }

    public function forceDestroy($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->route('projects.index')->with('success', 'Projeto excluído permanentemente!');
    }
}
