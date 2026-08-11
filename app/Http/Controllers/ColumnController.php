<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $project = Project::findOrFail($projectId);
        $lastOrder = $project->columns()->max('order') ?? -1;

        $column = $project->columns()->create([
            'name' => $request->name,
            'order' => $lastOrder + 1
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Coluna adicionada com sucesso!',
            'column' => $column
        ]);
    }
}
