@extends('layouts.app')

@section('title', 'Meus Projetos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0"><i class="bi bi-folder2-open text-primary-custom me-2"></i> Meus Projetos</h2>
        <a href="#" class="btn btn-primary-custom">
            <i class="bi bi-plus-lg"></i> Novo Projeto
        </a>
    </div>

    <div class="row">
        @forelse($projects as $project)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $project->name }}</h5>
                        <p class="card-text text-muted">{{ $project->description }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 text-end">
                        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-right"></i> Acessar Board</a>
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
@endsection