@extends('layouts.layout')

@section('title', $task->title)

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">

        <div class="mb-4">
            <a href="{{ route('tasks.index') }}" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left me-1"></i>Volver a la lista
            </a>
        </div>

        <div class="card">
            {{-- Header with status badge --}}
            <div class="card-header py-3 d-flex justify-content-between align-items-center
                        {{ $task->completed ? 'bg-success text-white' : 'bg-light' }}">
                <h5 class="mb-0">
                    <i class="bi bi-{{ $task->completed ? 'check-circle-fill' : 'circle' }} me-2"></i>
                    Detalle de Tarea
                </h5>
                <span class="badge rounded-pill fs-6
                             {{ $task->completed ? 'bg-white text-success' : 'bg-warning text-dark' }}">
                    {{ $task->completed ? 'Completada' : 'Pendiente' }}
                </span>
            </div>

            <div class="card-body p-4">

                {{-- Title --}}
                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-semibold">Título</label>
                    <h3 class="mt-1 {{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}">
                        {{ $task->title }}
                    </h3>
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-semibold">Descripción</label>
                    <div class="mt-1 p-3 bg-light rounded">
                        @if($task->description)
                            <p class="mb-0">{{ $task->description }}</p>
                        @else
                            <p class="mb-0 text-muted fst-italic">Sin descripción.</p>
                        @endif
                    </div>
                </div>

                {{-- Timestamps --}}
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="p-3 border rounded text-center">
                            <div class="text-muted small mb-1">
                                <i class="bi bi-calendar-plus me-1"></i>Fecha de creación
                            </div>
                            <div class="fw-semibold">{{ $task->created_at->format('d/m/Y') }}</div>
                            <div class="text-muted small">{{ $task->created_at->format('H:i') }} · {{ $task->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 border rounded text-center">
                            <div class="text-muted small mb-1">
                                <i class="bi bi-calendar-check me-1"></i>Última actualización
                            </div>
                            <div class="fw-semibold">{{ $task->updated_at->format('d/m/Y') }}</div>
                            <div class="text-muted small">{{ $task->updated_at->format('H:i') }} · {{ $task->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Editar
                    </a>

                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $task->completed ? 'btn-outline-secondary' : 'btn-success' }}">
                            <i class="bi {{ $task->completed ? 'bi-arrow-counterclockwise' : 'bi-check-lg' }} me-1"></i>
                            {{ $task->completed ? 'Marcar como pendiente' : 'Marcar como completada' }}
                        </button>
                    </form>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="ms-auto"
                          onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-trash me-1"></i>Eliminar
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
