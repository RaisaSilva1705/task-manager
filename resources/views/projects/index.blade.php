@extends('layouts.app')

@section('title', 'Meus Projetos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0"><i class="bi bi-folder2-open text-primary-custom me-2"></i> Meus Projetos</h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg"></i> Novo Projeto
        </a>
    </div>

    <div class="row">
        @forelse($projects as $project)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title fw-bold">{{ $project->name }}</h5>
                            <div class="dropdown">
                                <button class="btn btn-link text-secondary p-0 border-0 text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Opções do Projeto">
                                    <i class="bi bi-three-dots-vertical fs-5"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li>
                                        <button class="dropdown-item py-2" type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editProjectModal"
                                            data-id="{{ $project->id }}"
                                            data-name="{{ $project->name }}"
                                            data-description="{{ $project->description }}"
                                        >
                                            <i class="bi bi-pencil text-secondary me-2"></i> Editar Projeto
                                        </button>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja arquivar este projeto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item py-2">
                                                <i class="bi bi-archive me-2"></i> Arquivar Projeto
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('projects.forceDestroy', $project->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja EXCLUIR PERMANENTEMENTE este projeto? Esta ação não pode ser desfeita.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item py-2 text-danger">
                                                <i class="bi bi-trash3 me-2"></i> Excluir Permanentemente
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="card-text text-muted">{{ $project->description }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 text-end">
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-right"></i> Acessar Board
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info align-items-center shadow-sm">
                    <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                    <div>
                        <strong>Nenhum projeto encontrado!</strong><br>
                        Clique em "Novo Projeto" para criar o seu primeiro projeto.
                    </div>
                </div>
            </div>
        @endempty
    </div>

    <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold">Editar Projeto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProjectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body pt-0">
                        <div class="mb-3">
                            <label for="edit_project_name" class="form-label fw-bold">Nome</label>
                            <input type="text" class="form-control" id="edit_project_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_project_description" class="form-label fw-bold">Descrição</label>
                            <textarea class="form-control" id="edit_project_description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 bg-light d-flex justify-content-between">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary-custom">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editProjectModal = document.getElementById('editProjectModal');
            
            if (editProjectModal) {
                editProjectModal.addEventListener('show.bs.modal', event => {
                    const button = event.relatedTarget;
                    const projectId = button.getAttribute('data-id');
                    const projectName = button.getAttribute('data-name');
                    const projectDescription = button.getAttribute('data-description');

                    document.getElementById('edit_project_name').value = projectName;
                    document.getElementById('edit_project_description').value = projectDescription;

                    const form = document.getElementById('editProjectForm');
                    form.action = `/projetos/${projectId}`;
                });
            }
        });
    </script>
@endsection