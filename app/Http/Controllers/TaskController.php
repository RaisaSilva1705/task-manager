<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request, $projectId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'column_id' => 'required|exists:columns,id'
        ]);

        $project = Project::findOrFail($projectId);

        $project->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'column_id' => $validated['column_id'],
            'order' => 0
        ]);

        return back()->with('success', 'Tarefa criada com sucesso!');
    }

    public function move(Request $request, $taskId)
    {
        $request->validate([
            'column_id' => 'required|exists:columns,id',
            'task_ids' => 'nullable|array'
        ]);

        $task = Task::findOrFail($taskId);
        $task->update(['column_id' => $request->column_id]);

        if ($request->has('task_ids')){
            foreach ($request->task_ids as $index => $id){
                Task::where('id', $id)->update(['order' => $index]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Posição atualizada com sucesso!']);
    }

    public function destroy(Task $task)
    {
        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('projects.show', $projectId);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $task->update($validated);

        return redirect()->route('projects.show', $task->project_id);
    }
}