@extends('layouts.app')

@section('title', 'Novo Projeto')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-shadow-sm-border-0">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0">
                    <h3 class="mb-0"><i class="bi bi-folder-plus text-primary-custom me-2"></i> Criar Novo Projeto</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nome do Projeto <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Ex: Reforma do Escritório" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Descrição <span class="text-muted">(Opcional)</span></label>
                            <textarea name="description" id="description" rows="3" class="form-control" placeholder="Detalhes sobre o projeto..."></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">Modelo do Projeto</label>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <input type="radio" class="btn-check" id="tpl_empty" name="template" value="empty" autocomplete="off" checked>
                                    <label class="btn btn-outline-secondary w-100 text-start p-3 h-100 shadow-sm" for="tpl_empty">
                                        <i class="bi bi-layout-sidebar fs-4 d-block mb-2"></i>
                                        <span class="fw-bold d-block mb-1">Em Branco</span>
                                        <span class="d-block small opacity-75">Modelo básico para criar um projeto do zero</span>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="radio" class="btn-check" id="tpl_simple" name="template" value="simple" autocomplete="off">
                                    <label class="btn btn-outline-secondary w-100 text-start p-3 h-100 shadow-sm" for="tpl_simple">
                                        <i class="bi bi-kanban fs-4 d-block mb-2"></i>
                                        <span class="fw-bold d-block mb-1">Básico</span>
                                        <span class="d-block small opacity-75">A Fazer, Em Andamento e Concluído</span>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="radio" class="btn-check" id="tpl_software" name="template" value="software" autocomplete="off">
                                    <label class="btn btn-outline-secondary w-100 text-start p-3 h-100 shadow-sm" for="tpl_software">
                                        <i class="bi bi-code-slash fs-4 d-block mb-2"></i>
                                        <span class="fw-bold d-block mb-1">Engenharia</span>
                                        <span class="d-block small opacity-75">Backlog, Code Review, Homologação...</span>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="radio" class="btn-check" id="tpl_okr" name="template" value="okr" autocomplete="off">
                                    <label class="btn btn-outline-secondary w-100 text-start p-3 h-100 shadow-sm" for="tpl_okr">
                                        <i class="bi bi-bullseye fs-4 d-block mb-2"></i>
                                        <span class="fw-bold d-block mb-1">Metas (OKR)</span>
                                        <span class="d-block small opacity-75">Objetivos, Resultados Chave, Iniciativas...</span>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="radio" class="btn-check" id="tpl_education" name="template" value="education" autocomplete="off">
                                    <label class="btn btn-outline-secondary w-100 text-start p-3 h-100 shadow-sm" for="tpl_education">
                                        <i class="bi bi-book fs-4 d-block mb-2"></i>
                                        <span class="fw-bold d-block mb-1">Educação e Estudos</span>
                                        <span class="d-block small opacity-75">Aulas para Assistir, Livros, Leituras, Resumos...</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('projects.index') }}" class="btn btn-light border"><i class="bi bi-x-lg me-1"></i> Cancelar</a>
                            <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-lg me-1"></i> Criar Projeto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection