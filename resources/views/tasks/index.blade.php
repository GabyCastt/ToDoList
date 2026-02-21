@extends('layouts.layout')

@section('title', 'Mis Tareas')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1 fw-bold">
            <i class="bi bi-list-task text-primary me-2"></i>Mis Tareas
        </h1>
        <p class="text-muted mb-0">
            {{ $tasks->total() }} tarea(s) en total
        </p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nueva Tarea
    </a>
</div>

{{-- Stats summary --}}
@if($tasks->total() > 0)
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="card text-center py-3">
            <div class="h2 fw-bold text-primary mb-1">{{ $tasks->total() }}</div>
            <div class="text-muted small">Total</div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card text-center py-3">
            <div class="h2 fw-bold text-success mb-1">
                {{ \App\Models\Task::where('completed', true)->count() }}
            </div>
            <div class="text-muted small">Completadas</div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card text-center py-3">
            <div class="h2 fw-bold text-warning mb-1">
                {{ \App\Models\Task::where('completed', false)->count() }}
            </div>
            <div class="text-muted small">Pendientes</div>
        </div>
    </div>
</div>
@endif

{{-- Task list --}}
@forelse ($tasks as $task)
    <div class="card mb-3 task-item {{ $task->completed ? 'task-completed' : '' }}">
        <div class="card-body d-flex align-items-start gap-3">

            {{-- Toggle complete button --}}
            <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="mt-1">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="btn btn-sm {{ $task->completed ? 'btn-success' : 'btn-outline-secondary' }}"
                        title="{{ $task->completed ? 'Marcar como pendiente' : 'Marcar como completada' }}">
                    <i class="bi {{ $task->completed ? 'bi-check-circle-fill' : 'bi-circle' }}"></i>
                </button>
            </form>

            {{-- Task info --}}
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="task-title fw-semibold fs-5">{{ $task->title }}</span>
                    <span class="badge rounded-pill {{ $task->completed ? 'badge-completed' : 'badge-pending' }}">
                        {{ $task->completed ? 'Completada' : 'Pendiente' }}
                    </span>
                </div>

                @if($task->description)
                    <p class="text-muted mb-1 small">
                        {{ Str::limit($task->description, 100) }}
                    </p>
                @endif

                <small class="text-muted">
                    <i class="bi bi-clock me-1"></i>
                    Creada {{ $task->created_at->diffForHumans() }}
                </small>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2 flex-shrink-0">
                <a href="{{ route('tasks.show', $task) }}"
                   class="btn btn-outline-info btn-action" title="Ver detalle">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('tasks.edit', $task) }}"
                   class="btn btn-outline-warning btn-action" title="Editar">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                      onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-action" title="Eliminar">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
@empty
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
            <h5 class="mt-3 text-muted">No tienes tareas todavía</h5>
            <p class="text-muted">¡Empieza creando tu primera tarea!</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-2">
                <i class="bi bi-plus-lg me-1"></i>Crear Primera Tarea
            </a>
        </div>
    </div>
@endforelse

{{-- Pagination --}}
@if($tasks->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $tasks->links() }}
    </div>
@endif

@endsection
