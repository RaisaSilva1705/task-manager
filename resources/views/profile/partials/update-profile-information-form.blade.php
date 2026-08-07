<section>
    <header class="mb-4">
        <h4 class="fw-bold">Informações do Perfil</h4>
        <p class="text-muted small">Atualize as informações do seu perfil e endereço de email.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nome</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label fw-bold">Foto de Perfil</label>
            @if (Auth::user()->avatar)
                <div class="mb-2">
                    <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle" width="100" height="100">
                </div>
            @endif
            <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
            @error('avatar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-bold">E-mail</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted small mb-1">Seu endereço de e-mail não está verificado.</p>
                    <button form="send-verification" class="btn btn-link p-0 text-decoration-none small">Clique aqui para reenviar o e-mail de verificação.</button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small mt-1">Um novo link de verificação foi enviado para o seu endereço de e-mail.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-4">
            <label for="theme" class="form-label fw-bold">Tema Visual</label>
            <select id="theme" name="theme" class="form-select @error('theme') is-invalid @enderror">
                <option value="ocean_blue" {{ Auth::user()->theme === 'ocean_blue' ? 'selected' : '' }}>Ocean Blue</option>
                <option value="forest_mint" {{ Auth::user()->theme === 'forest_mint' ? 'selected' : '' }}>Forest Mint</option>
                <option value="sunset_coral" {{ Auth::user()->theme === 'sunset_coral' ? 'selected' : '' }}>Sunset Coral</option>
                <option value="deep_purple" {{ Auth::user()->theme === 'deep_purple' ? 'selected' : '' }}>Deep Purple</option>
                <option value="monochrome_slate" {{ Auth::user()->theme === 'monochrome_slate' ? 'selected' : '' }}>Monochrome Slate</option>
            </select>
            @error('theme')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn btn-primary-custom px-4 fw-bold">Salvar</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small fw-bold">
                    <i class="bi bi-check-circle"></i> Salvo.
                </span>
            @endif
        </div>
    </form>
</section>
