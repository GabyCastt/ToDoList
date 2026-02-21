<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestor de Tareas') — To-Do App</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: 0.5px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
        }

        .task-item {
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .task-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12) !important;
        }

        .task-completed .task-title {
            text-decoration: line-through;
            opacity: 0.55;
        }

        .badge-completed {
            background-color: #198754;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-action {
            padding: 0.3rem 0.65rem;
            font-size: 0.82rem;
        }

        footer {
            margin-top: 3rem;
            padding: 1.5rem 0;
            color: #6c757d;
            font-size: 0.875rem;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('tasks.index') }}">
            <i class="bi bi-check2-square me-2"></i>To-Do App
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}"
                       href="{{ route('tasks.index') }}">
                        <i class="bi bi-list-task me-1"></i>Mis Tareas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tasks.create') ? 'active' : '' }}"
                       href="{{ route('tasks.create') }}">
                        <i class="bi bi-plus-circle me-1"></i>Nueva Tarea
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Main content --}}
<main class="container my-4">

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center"
             role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center"
             role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<footer class="text-center">
    <div class="container">
        <p class="mb-0">
            <i class="bi bi-code-slash me-1"></i>
            Gestor de Tareas — Construido con <strong>Laravel</strong> y <strong>Bootstrap 5</strong>
        </p>
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
