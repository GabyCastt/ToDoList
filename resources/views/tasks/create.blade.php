@extends('layouts.layout')

@section('title', 'Nueva Tarea')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">

        <div class="mb-4">
            <a href="{{ route('tasks.index') }}" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left me-1"></i>Volver a la lista
            </a>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">
                    <i class="bi bi-plus-circle me-2"></i>Crear Nueva Tarea
                </h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('tasks.store') }}" method="POST" novalidate>
                    @csrf

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
                            value="{{ old('title') }}"
                            placeholder="Ej: Comprar groceries..."
                            autofocus
                            required
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
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Máximo 1000 caracteres recomendados.</div>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="bi bi-check-lg me-1"></i>Guardar Tarea
                        </button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-x-lg me-1"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
