<section>
    <header class="mb-4">
        <h4 class="fw-bold">Atualizar Senha</h4>
        <p class="text-muted small">Garanta que sua conta esteja usando uma senha longa e aleatória para se manter segura.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-bold">Senha Atual</label>
            <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="update_password_current_password" name="current_password" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-bold">Nova Senha</label>
            <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="update_password_password" name="password" autocomplete="new-password">
            @error('password', 'updatePassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-bold">Confirmar Senha</label>
            <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary-custom px-4 fw-bold">Salvar</button>
            @if (session('status') === 'password-updated')
                <span class="text-success small fw-bold"><i class="bi bi-check-circle"></i> Salva.</span>
            @endif
        </div>
    </form>
</section>