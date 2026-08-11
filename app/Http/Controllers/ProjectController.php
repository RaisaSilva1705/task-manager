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
            'template' => 'nullable|string',
        ]);

        $project = Auth::user()->projects()->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        $template = $request->input('template', 'empty');
        $columns = [];

        if ($template === 'simple') {
            $columns = [
                'A Fazer',
                'Em Andamento',
                'Concluído',
            ];
        }
        elseif ($template === 'development') {
            $columns = [
                'Backlog',
                'A Fazer',
                'Em Desenvovimento',
                'Code Review',
                'Homologação',
                'Produção',
            ];
        }
        elseif ($template === 'okr') {
            $columns = [
                'Objetivos',
                'Resultados Chave',
                'Iniciativas',
                'Avaliando',
                'Concluído',
            ];
        }
        elseif ($template === 'education') {
            $columns = [
                'Aulas para Assistir',
                'Leituras',
                'Resumos',
                'Exercícios',
                'Revisão',
            ];
        }

        foreach ($columns as $index => $columnName) {
            $project->columns()->create([
                'name' => $columnName,
                'order' => $index,
            ]);
        }

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
