<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $project->tasks()->create($validated);

        return redirect()->route('projects.show', $project->id);
    }
}