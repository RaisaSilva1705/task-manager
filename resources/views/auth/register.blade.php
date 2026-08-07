@extends('layouts.app')

@section('title', 'Cadastro - TaskManager')

@section('content')
    <div class="row justify-content-center align-items-center" style="min-height: 70vh">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary-custom"><i class="bi bi-person-plus-fill"></i> Criar Conta</h3>
                        <p class="text-muted">Junte-se a nós e comece a gerenciar suas tarefas</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary-custom py-2 fw-bold">Cadastrar</button>
                        </div>
                        <div class="text-center mt-4">
                            <span class="text-muted">Já tem uma conta?</span>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold ms-1">Faça login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection