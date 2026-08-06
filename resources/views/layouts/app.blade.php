<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'TaskManager')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <style>
            :root { --primary-color: #0d6efd; }
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
                    <button class="btn btn-outline-secondary btn-sm me-2" id="theme-toggle" title="Alterar Tema">
                        <i class="bi bi-moon-fill" id="theme-icon"></i>
                    </button>
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