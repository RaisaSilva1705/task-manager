@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="m-0 fw-bold"><i class="bi bi-kanban text-primary-custom me-2"></i> {{ $project->name }}</h2>
            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Voltar para Projetos
            </a>
        </div>
        @if ($project->description)
            <p class="text-muted"><i class="bi bi-card-text me-1"></i> {{ $project->description }}</p>
        @endif
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-body-secondary border-0 h-100">
                <div class="card-header border-bottom-0 pt-3 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-circle text-secondary me-2"></i> A Fazer</h5>
                </div>
                <div class="card-body task-column" id="column-todo" data-status="todo">
                    @foreach ($project->tasks->where('status', 'todo') as $task)
                        <div class="card shadow-sm mb-2 border-0 task-card cursor-grab" data-id="{{ $task->id }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="card-title fw-bold mb-1">{{ $task->title }}</h6>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-link text-secondary p-0 ms-2" title="Editar Tarefa" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTaskModal" 
                                            data-id="{{ $task->id }}"
                                            data-title="{{ $task->title }}"
                                            data-description="{{ $task->description }}">
                                            <i class="bi bi-pencil me-1"></i>
                                        </button>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 ms-2" title="Excluir Tarefa">
                                                <i class="bi bi-trash3 me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if ($task->description)
                                    <p class="card-text small text-muted mb-0">{{ Str::limit($task->description, 60) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="d-grid mt-2">
                        <button class="btn btn-sm btn-outline-secondary text-start border-dashed" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                            <i class="bi bi-plus me-1"></i> Nova Tarefa
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-body-secondary border-0 h-100">
                <div class="card-header border-bottom-0 pt-3 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-play-circle text-primary-custom me-2"></i> Em Progresso</h5>
                </div>
                <div class="card-body task-column" id="column-in-progress" data-status="in_progress">
                    @foreach ($project->tasks->where('status', 'in_progress') as $task)
                        <div class="card shadow-sm mb-2 border-0 task-card cursor-grab" data-id="{{ $task->id }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="card-title fw-bold mb-1">{{ $task->title }}</h6>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-link text-secondary p-0 ms-2" title="Editar Tarefa" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTaskModal" 
                                            data-id="{{ $task->id }}"
                                            data-title="{{ $task->title }}"
                                            data-description="{{ $task->description }}">
                                            <i class="bi bi-pencil me-1"></i>
                                        </button>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 ms-2" title="Excluir Tarefa">
                                                <i class="bi bi-trash3 me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if ($task->description)
                                    <p class="card-text small text-muted mb-0">{{ Str::limit($task->description, 60) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-body-secondary border-0 h-100">
                <div class="card-header border-bottom-0 pt-3 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-check2-circle text-success me-2"></i> Concluído</h5>
                </div>
                <div class="card-body task-column" id="column-done" data-status="done">
                    @foreach ($project->tasks->where('status', 'done') as $task)
                        <div class="card shadow-sm mb-2 border-0 task-card cursor-grab" data-id="{{ $task->id }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="card-title fw-bold mb-1">{{ $task->title }}</h6>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-link text-secondary p-0 ms-2" title="Editar Tarefa" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTaskModal" 
                                            data-id="{{ $task->id }}"
                                            data-title="{{ $task->title }}"
                                            data-description="{{ $task->description }}">
                                            <i class="bi bi-pencil me-1"></i>
                                        </button>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 ms-2" title="Excluir Tarefa">
                                                <i class="bi bi-trash3 me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if ($task->description)
                                    <p class="card-text small text-muted mb-0">{{ Str::limit($task->description, 60) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para criar nova tarefa --}}
    <div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="newTaskModalLabel">Adicionar Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tasks.store', $project->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">O que precisa ser feito?</label>
                            <input type="text" class="form-control" id="title" name="title" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Detalhes <span class="text-muted">(opcional)</span></label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 bg-light">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary-custom">Salvar Tarefa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal para editar tarefa --}}
    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold" id="editTaskModalLabel">Editar Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editTaskForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body pt-0">
                        <div class="mb-3">
                            <label for="edit_title" class="form-label fw-bold">O que precisa ser feito?</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label fw-bold">Detalhes <span class="text-muted">(opcional)</span></label>
                            <textarea class="form-control" id="edit_description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 bg-light">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary-custom">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .border-dashed {
            border-style: dashed !important;
            border-width: 2px !important;
        }
        .cursor-grab { cursor: grab; }
        .cursor-grab:active { cursor: grabbing; }
        .sortable-ghost {
            opacity: 0.4;
            background-color: #f8f9fa;
            border: 2px dashed #0d6efd !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const columns = document.querySelectorAll('.task-column');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            columns.forEach(column => {
                new Sortable(column, {
                    group: 'kanban',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    onEnd: function (evt) {
                        const itemEl = evt.item;
                        const taskId = itemEl.getAttribute('data-id');
                        const newStatus = evt.to.getAttribute('data-status');

                        if (evt.from === evt.to) return;

                        fetch(`/tarefas/${taskId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ status: newStatus })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log(`Tarefa atualizada com sucesso para o status: ${newStatus}`);
                            } else {
                                console.error('Erro ao atualizar o status da tarefa:', data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao atualizar o status da tarefa:', error);
                            alert('Ocorreu um erro ao atualizar o status da tarefa. Por favor, tente novamente.');
                        });
                    }
                });
            });
        });

        const editTaskModal = document.getElementById('editTaskModal');
        if (editTaskModal) {
            editTaskModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const taskId = button.getAttribute('data-id');
                const title = button.getAttribute('data-title');
                const description = button.getAttribute('data-description');

                document.getElementById('edit_title').value = title;
                document.getElementById('edit_description').value = description || '';

                const form = document.getElementById('editTaskForm');
                form.action = `/tarefas/${taskId}`;
            });
        }
    </script>
@endsection