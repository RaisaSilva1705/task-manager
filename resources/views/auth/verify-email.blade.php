@extends('layouts.app')

@section('title', 'Verificar E-mail - TaskManager')

@section('content')
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary-custom"><i class="bi bi-envelope-check"></i> Quase lá!</h3>
                        <p class="text-muted small">Obrigado por se registrar! Antes de começar, por favor verifique seu e-mail para obter o link de verificação.</p>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success small shadow-sm" role="alert">
                            Um novo link de verificação foi enviado para o seu endereço de e-mail {{ auth()->user()->email }}.
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary-custom btn-sm fw-bold">Reenviar E-mail</button>
                        </form>
    
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger btn-sm text-decoration-none">Sair</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection