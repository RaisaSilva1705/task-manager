@extends('layouts.app')

@section('title', 'Login - TaskManager')

@section('content')
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary-custom"><i class="bi bi-box-arrow-in-right"></i> Faça Login</h3>
                        <p class="text-muted">Faça login para gerenciar suas tarefas</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label">Senha</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="small text-decoration-none">Esqueceu sua senha?</a>
                                @endif
                            </div>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                            <label for="remember_me" class="form-check-label select-none">Lembrar-me</label>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary-custom py-2 fw-bold">Entrar</button>
                        </div>
                        <div class="text-center mt-4">
                            <span class="text-muted">Não tem uma conta?</span>
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold ms-1">Cadastre-se</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection