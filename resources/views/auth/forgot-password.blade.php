@extends('layouts.app')

@section('title', 'Recuperar Senha - TaskManager')

@section('content')
    <div class="row-justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary-custom"><i class="bi bi-key-fill"></i> Recuperar Senha</h3>
                        <p class="text-muted small">Esqueceu sua senha? Sem problemas. Informe seu e-mail e enviaremos um link para redefinir sua senha.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success small shadow-sm" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary-custom py-2 fw-bold">Enviar Link de Redefinição</button>
                        </div>

                        <div class="text-center mt-4">
                            <span class="text-muted">Lembrou sua senha?</span>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold ms-1">Faça Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection