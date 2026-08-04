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