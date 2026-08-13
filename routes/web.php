<?php

use App\Http\Controllers\ColumnController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index'])->middleware(['auth', 'verified'])->name('projects.index');

Route::middleware('auth')->group(function () {
    // Projetos
    Route::get('/projetos/novo', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projetos', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projetos/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('/projetos/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projetos/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::delete('/projetos/{project}/force', [ProjectController::class, 'forceDestroy'])->name('projects.forceDestroy');

    // Colunas
    Route::post('/projetos/{projects}/colunas', [ColumnController::class, 'store'])->name('columns.store');
    Route::patch('/projetos/{projects}/colunas/reorder', [ColumnController::class, 'reorder'])->name('columns.reorder');
    Route::put('/colunas/{column}', [ColumnController::class, 'update'])->name('columns.update');
    Route::delete('/colunas/{column}', [ColumnController::class, 'destroy'])->name('columns.destroy');

    // Tarefas
    Route::post('/projetos/{project}/tarefas', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tarefas/{task}/move', [TaskController::class, 'move'])->name('tasks.move');
    Route::put('/tarefas/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tarefas/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
