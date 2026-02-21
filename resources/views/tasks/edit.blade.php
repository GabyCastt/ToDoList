@extends('layouts.layout')

@section('title', 'Editar Tarea')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">

        <div class="mb-4">
            <a href="{{ route('tasks.index') }}" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left me-1"></i>Volver a la lista
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-warning text-dark py-3">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Editar Tarea
                </h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('tasks.update', $task) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">
                            Título <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control form-control-lg @error('title') is-invalid @enderror"
                            value="{{ old('title', $task->title) }}"
                            required
                            autofocus
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">
                            Descripción <span class="text-muted fw-normal">(opcional)</span>
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Agrega más detalles sobre esta tarea..."
                        >{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Completed toggle --}}
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="completed"
                                name="completed"
                                value="1"
                                {{ old('completed', $task->completed) ? 'checked' : '' }}
                            >
                            <label class="form-check-label fw-semibold" for="completed">
                                Marcar como completada
                            </label>
                        </div>
                    </div>

                    {{-- Meta info --}}
                    <div class="bg-light rounded p-3 mb-4 small text-muted">
                        <div><i class="bi bi-calendar-plus me-1"></i>Creada: {{ $task->created_at->format('d/m/Y H:i') }}</div>
                        <div><i class="bi bi-calendar-check me-1"></i>Actualizada: {{ $task->updated_at->format('d/m/Y H:i') }}</div>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning flex-fill fw-semibold">
                            <i class="bi bi-save me-1"></i>Actualizar Tarea
                        </button>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-x-lg me-1"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
