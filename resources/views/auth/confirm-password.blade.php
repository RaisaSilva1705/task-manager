@extends('layouts.app')

@section('title', 'Confirmar Senha - TaskManager')

@section('content')
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold"><i class="bi bi-shield-lock text-primary-custom"></i> Área Segura</h4>
                        <p class="text-muted small">Esta é uma área segura da aplicação. Por favor, confirme sua senha antes de continuar.</p>
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Senha</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary-custom py-2 fw-bold px-4">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection