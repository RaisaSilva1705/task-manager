<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index'])->name('projects.index');

Route::get('/projetos/novo', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projetos', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projetos/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::post('/projetos/{project}/tarefas', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tarefas/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::delete('/tarefas/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::put('/tarefas/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::put('/projetos/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projetos/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::delete('/projetos/{project}/force', [ProjectController::class, 'forceDestroy'])->name('projects.forceDestroy');