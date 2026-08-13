<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Column;
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

    public function reorder(Request $request, $projectId)
    {
        $request->validate([
            'column_ids' => 'required|array'
        ]);

        foreach ($request->column_ids as $index => $id) {
            Column::where('id', $id)
                ->where('project_id', $projectId)
                ->update(['order' => $index]);
        }


        return response()->json(['success' => true, 'message' => 'Ordem das colunas salva!']);
    }

    public function update(Request $request, Column $column)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $column->update(['name' => $request->name]);

        return response()->json(['success' => true, 'message' => 'Coluna renomeada com sucesso!']);
    }

    public function destroy(Column $column)
    {
        $column->delete();

        return response()->json(['success' => true, 'message' => 'Coluna excluída com sucesso!']);
    }
}
