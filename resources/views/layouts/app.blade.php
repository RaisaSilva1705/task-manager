<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'TaskManager')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <style>
            @php
                $currentTheme = Auth::check() ? Auth::user()->theme : 'ocean_blue';
                $palettes = [
                    'ocean_blue' => ['primary' => '#0d6efd', 'secondary' => '#0dcaf0'],
                    'forest_mint' => ['primary' => '#198754', 'secondary' => '#20c997'],
                    'sunset_coral' => ['primary' => '#fd7e14', 'secondary' => '#ffc107'],
                    'deep_purple' => ['primary' => '#6f42c1', 'secondary' => '#d63384'],
                    'monochrome_slate' => ['primary' => '#495057', 'secondary' => '#6c757d'],
                ];
                $primaryColor = $palettes[$currentTheme]['primary'];
            @endphp
            
            :root { --primary-color: {{ $primaryColor }}; }
            .text-primary-custom { color: var(--primary-color) !important; }
            .bg-primary-custom { background-color: var(--primary-color) !important; color: white; }
            .btn-primary-custom { background-color: var(--primary-color); color: white; border: none; }
            .btn-primary-custom:hover { opacity: 0.9; color: white; }
        </style>
    </head>
    <body class="bg-body-tertiary">
        <nav class="navbar navbar-expand-lg bg-body shadow-sm mb-4">
            <div class="container">
                <a href="{{ route('projects.index') }}" class="navbar-brand fw-bold text-primary-custom">
                    <i class="bi bi-kanban"></i> TaskManager
                </a>

                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary btn-sm me-3" id="theme-toggle" title="Alterar Tema">
                        <i class="bi bi-moon-fill" id="theme-icon"></i>
                    </button>

                    @auth
                    <div class="dropdown">
                        <button class="btn btn-light border-0 dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                            @else
                                <i class="bi bi-person-circle fs-5 me-2 text-primary-custom"></i>
                            @endif
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Meu Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Sair
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="container">
            {{-- Flash messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')

            @isset($header)
                <header class="mb-4">
                    <h2 class="fs-4 fw-bold">{{ $header }}</h2>
                </header>
            @endisset

            {{ $slot ?? ''}}
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const htmlElement = document.documentElement;

            const savedTheme = localStorage.getItem('theme') || 'light';
            htmlElement.setAttribute('data-bs-theme', savedTheme);
            updateIcon(savedTheme);

            themeToggleBtn.addEventListener('click', () => {
                const currentTheme = htmlElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                htmlElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });

            function updateIcon(theme) {
                if (theme === 'dark') {
                    themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
                    themeToggleBtn.classList.replace('btn-outline-secondary', 'btn-outline-warning');
                } 
                else {
                    themeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
                    themeToggleBtn.classList.replace('btn-outline-warning', 'btn-outline-secondary');
                }
            }
        </script>
    </body>
</html>