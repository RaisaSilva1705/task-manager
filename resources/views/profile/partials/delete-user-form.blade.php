<section>
    <header class="mb-4">
        <h4 class="fw-bold text-danger">Excluir Conta</h4>
        <p class="text-muted small">Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, baixe todos os dados ou informações que deseja reter.</p>
    </header>

    <button type="button" class="btn btn-outline-danger fw-bold" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        Excluir Conta
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title fw-bold" id="confirmUserDeletionModalLabel">Tem certeza que deseja excluir sua conta?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted small mb-4">Depois que sua conta for excluída, todos os recursos e dados serão excluídos permanentemente. Digite sua senha para confirmar que deseja excluir permanentemente sua conta.</p>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold d-none">Senha</label>
                            <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="password" name="password" placeholder="Sua Senha Atual">
                            @error('password', 'userDeletion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger fw-bold">Excluir Conta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>