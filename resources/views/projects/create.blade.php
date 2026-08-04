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
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Descrição <span class="text-muted">(Opcional)</span></label>
                            <textarea name="description" id="description" rows="3" class="form-control" placeholder="Detalhes sobre o projeto..."></textarea>
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