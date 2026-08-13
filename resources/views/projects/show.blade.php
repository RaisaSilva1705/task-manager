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

    <div class="d-flex overflow-x-auto align-items-start pb-4" id="kanban-board" style="gap: 1.5rem; min-height: 65vh;">
        @foreach ($project->columns as $column)
            <div class="card bg-body-secondary border-0 flex-shrink-0" style="width: 320px;">
                <div class="card-header border-bottom-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold m-0">{{ $column->name }}</h5>
                    <div class="dropdown">
                        <button type="button" class="btn btn-link text-secondary p-0 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu shadow-sm border-0">
                            <li>
                                <h6 class="dropdown-header text-uppercase" style="font-size: 0.75rem;">Ações da Coluna</h6>
                            </li>
                            <li><button type="button" class="dropdown-item small"><i class="bi bi-pencil me-2 text-muted"></i> Renomear Coluna</button></li>
                            <li><button type="button" class="dropdown-item small"><i class="bi bi-arrows-move me-2 text-muted"></i> Mover Coluna</button></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><button type="button" class="dropdown-item small"><i class="bi bi-palette me-2 text-muted"></i> Alterar Cor</button></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><button type="button" class="dropdown-item small text-danger btn-delete-column" data-column-id="{{ $column->id }}"><i class="bi bi-trash3 me-2"></i> Excluir</button></li>
                        </ul>
                    </div>
                </div>

                <div class="card-body task-column" id="column-{{ $column->id }}" data-column-id="{{ $column->id }}">
                    @foreach ($column->tasks as $task)
                        <div class="card shadow-sm mb-2 border-0 task-card cursor-grab" data-id="{{ $task->id }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="card-title fw-bold mb-1">{{ $task->title }}</h6>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-link text-secondary p-0 ms-2" data-bs-toggle="modal" data-bs-target="#editTaskModal" data-id="{{ $task->id }}" data-title="{{ $task->title }}" data-description="{{ $task->description }}">
                                            <i class="bi bi-pencil me-1"></i>
                                        </button>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Deseja excluir esta tarefa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 ms-2">
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
                        <button class="btn btn-sm btn-outline-secondary text-start border-dashed btn-add-task" data-bs-toggle="modal" data-bs-target="#newTaskModal" data-column-id="{{ $column->id }}">
                            <i class="bi bi-plus me-1"></i> Nova Tarefa
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="card bg-transparent border-dashed flex-shrink-0 d-flex justify-content-center align-items-center" id="ghost-column-btn" style="width: 320px; min-height: 120px; cursor: pointer; border-color: #adb5bd !important;">
            <h5 class="text-muted m-0 fw-bold"><i class="bi bi-plus-lg me-2"></i> Nova Coluna</h5>
        </div>

        <div class="card bg-body-tertiary border-0 shadow-sm flex-shrink-0 d-none" id="ghost-column-form" style="width: 320px;">
            <div class="card-body p-3">
                <form id="new-column-form" action="{{ route('columns.store', $project->id) }}" method="POST">
                    @csrf
                    <input type="text" class="form-control border-primary-custom mb-2 shadown-sm" id="new-column-input" name="name" placeholder="Nome da Coluna..." required>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btm-sm btn-secondary text-muted border-0" id="cancel-column-btn">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary-custom fw-bold px-3">Adicionar</button>
                    </div>
                </form>
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
                    <input type="hidden" name="column_id" id="task_column_id">
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

    {{-- Modal para excluir coluna --}}
    <div class="modal fade" id="deleteColumnModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold text-danger"><i class="bi bi-exclamation-triangle me-2"></i> Excluir Coluna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <p>Tem certeza que deseja excluir esta coluna?</p>
                    <p class="text-danger small fw-bold mb-0">Atenção: Todas as tarefas dentro desta coluna serão excluídas permanentemente. Se não quiser perder essas terefas, arraste-as para outra coluna antes de excluir.</p>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger fw-bold" id="confirmDeleteColumnBtn">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        <div class="toast align-items-center text-bg-success border-0" id="kanbanToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-bold" id="toastMessage">
                    Ação realizada com sucesso!
                </div>
                <button type="button" class="btn-close white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
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
        .overflow-x-auto::-webkit-scrollbar { height: 8px; }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover { background: rgba(0, 0, 0, 0.3) }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Função Global de Toast
            function showToast(message, type = 'success') {
                const toastEl = document.getElementById('kanbanToast');
                const toastBody = document.getElementById('toastMessage');
                
                toastBody.textContent = message;
                
                if(type === 'error')
                    toastEl.classList.replace('text-bg-success', 'text-bg-danger');
                else
                    toastEl.classList.replace('text-bg-danger', 'text-bg-success');

                const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }

            // Lógica dos Modais de Tarefa
            const newTaskModal = document.getElementById('newTaskModal');
            if (newTaskModal) {
                newTaskModal.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;
                    document.getElementById('task_column_id').value = button.getAttribute('data-column-id');
                });
            }

            const editTaskModal = document.getElementById('editTaskModal');
            if (editTaskModal) {
                editTaskModal.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;
                    document.getElementById('edit_title').value = button.getAttribute('data-title');
                    document.getElementById('edit_description').value = button.getAttribute('data-description') || '';
                    document.getElementById('editTaskForm').action = `/tarefas/${button.getAttribute('data-id')}`;
                });
            }

            function initSortable(columnElement) {
                new Sortable(columnElement, {
                    group: 'kanban',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    scroll: true,
                    scrollSensitivity: 80,
                    scrollSpeed: 20,
                    onEnd: function (evt) {
                        const taskId = evt.item.getAttribute('data-id');
                        const newColumnId = evt.to.getAttribute('data-column-id');

                        const taskIds = Array.from(evt.to.querySelectorAll('.task-card'))
                                             .map(card => card.getAttribute('data-id'));

                        fetch(`/tarefas/${taskId}/move`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ 
                                column_id: newColumnId,
                                task_ids: taskIds
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showToast(data.message);
                            }
                        })
                        .catch(error => {
                            showToast('Erro ao mover a tarefa.', 'error');
                        });
                    }
                });
            }

            document.querySelectorAll('.task-column').forEach(column => initSortable(column));

            const kanbanBoard = document.getElementById('kanban-board');
            if (kanbanBoard){
                new Sortable(kanbanBoard, {
                    animation: 150,
                    handle: '.card-header',
                    filter: '#ghost-column-btn, #ghost-column-form',
                    ghostClass: 'sortable-ghost',
                    onEnd: function (evt) {
                        const columnIds = Array.from(kanbanBoard.querySelectorAll('.task-column'))
                                            .map(col => col.getAttribute('data-column-id'));
                        
                        fetch(`/projetos/{{ $project->id }}/colunas/reorder`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ column_ids: columnIds })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // showToast(data.message);
                            }
                        })
                        .catch(error => showToast('Erro ao reordenar as colunas.', 'error'));
                    }
                });
            }

            const ghostBtn = document.getElementById('ghost-column-btn');
            const ghostForm = document.getElementById('ghost-column-form');
            const ghostInput = document.getElementById('new-column-input');
            const newColumnForm = document.getElementById('new-column-form');

            if (ghostBtn && ghostForm) {
                ghostBtn.addEventListener('click', () => {
                    ghostBtn.classList.add('d-none');
                    ghostBtn.classList.remove('d-flex');
                    ghostForm.classList.remove('d-none');
                    ghostInput.focus();
                });

                document.getElementById('cancel-column-btn').addEventListener('click', () => {
                    ghostForm.classList.add('d-none');
                    ghostBtn.classList.remove('d-none');
                    ghostBtn.classList.add('d-flex');
                    ghostInput.value = '';
                });

                newColumnForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ name: ghostInput.value })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            ghostForm.classList.add('d-none');
                            ghostBtn.classList.remove('d-none', 'd-flex');
                            ghostBtn.classList.add('d-flex');
                            ghostInput.value = '';
                            
                            showToast(data.message);

                            const newColumnHtml = `
                                <div class="card bg-body-secondary border-0 flex-shrink-0" style="width: 320px;">
                                    <div class="card-header border-bottom-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold m-0">${data.column.name}</h5>
                                        <button class="btn btn-link text-secondary p-0 text-decoration-none"><i class="bi bi-three-dots"></i></button>
                                    </div>
                                    <div class="card-body task-column" id="column-${data.column.id}" data-column-id="${data.column.id}">
                                        <div class="d-grid mt-2">
                                            <button class="btn btn-sm btn-outline-secondary text-start border-dashed btn-add-task" data-bs-toggle="modal" data-bs-target="#newTaskModal" data-column-id="${data.column.id}">
                                                <i class="bi bi-plus me-1"></i> Nova Tarefa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            ghostBtn.insertAdjacentHTML('beforebegin', newColumnHtml);
                            
                            const newColumnBody = document.getElementById(`column-${data.column.id}`);
                            initSortable(newColumnBody);
                        }
                    })
                    .catch(error => {
                        showToast('Erro ao criar a coluna.', 'error');
                    });
                });
            }

            let columnIdToDelete = null;
            let deleteColumnModalInstance = null;
            const deleteColumnModalEl = document.getElementById('deleteColumnModal');

            if (deleteColumnModalEl)
                deleteColumnModalInstance = new bootstrap.Modal(deleteColumnModalEl);

            document.querySelectorAll('.btn-delete-column').forEach(btn => {
                btn.addEventListener('click', function() {
                    columnIdToDelete = this.getAttribute('data-column-id');
                    if (deleteColumnModalInstance)
                        deleteColumnModalInstance.show();
                });
            });

            const confirmDeleteBtn = document.getElementById('confirmDeleteColumnBtn');
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function() {
                    if (!columnIdToDelete) return;

                    fetch(`/colunas/${columnIdToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success){
                            showToast(data.message);

                            const columnEl = document.getElementById(`column-${columnIdToDelete}`).closest('.flex-shrink-0');
                            columnEl.style.transition = "opacity 0.3s ease, transform 0.3s ease";
                            columnEl.style.opacity = '0';
                            columnEl.style.tranform = "scale(0.9)";

                            setTimeout(() => {
                                columnEl.remove();
                            }, 300);

                            if (deleteColumnModalInstance)
                                deleteColumnModalInstance.hide();
                        }
                    })
                    .catch(error => showToast('Erro ao excluir a coluna.', 'error'));
                })
            }
        });
    </script>
@endsection