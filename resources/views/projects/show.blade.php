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
                <div class="card-body">
                    <div class="d-grid mt-2">
                        <button class="btn btn-outline-secondary text-start border-dashed"><i class="bi bi-plus-lg me-1"></i> Nova Tarefa</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-body-secondary border-0 h-100">
                <div class="card-header border-bottom-0 pt-3 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-play-circle text-primary-custom me-2"></i> Em Progresso</h5>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-body-secondary border-0 h-100">
                <div class="card-header border-bottom-0 pt-3 pb-0">
                    <h5 class="fw-bold"><i class="bi bi-check2-circle text-success me-2"></i> Concluído</h5>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-dashed {
            border-style: dashed !important;
            border-width: 2px !important;
        }
    </style>
@endsection