@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-title i {
        color: #1b4282;
    }

    .page-subtitle {
        font-size: 1rem;
        color: #666;
        font-weight: 400;
        margin-top: 0.5rem;
    }

    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        max-width: 900px;
        margin: 0 auto;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: start;
        gap: 12px;
        border: none;
    }

    .alert-danger {
        background: #ffebee;
        color: #c62828;
    }

    .alert-icon {
        font-size: 1.2rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .alert ul {
        margin: 0.5rem 0 0 0;
        padding-left: 1.5rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1b4282;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 14px;
    }

    .form-label.required::after {
        content: '*';
        color: #c62828;
        margin-left: 4px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 15px;
        color: #999;
        font-size: 16px;
        pointer-events: none;
        z-index: 1;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .form-control:focus {
        outline: none;
        border-color: #5299d4;
        background: white;
        box-shadow: 0 0 0 3px rgba(82, 153, 212, 0.1);
    }

    .form-hint {
        font-size: 13px;
        color: #999;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Select de Estado */
    .estado-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .estado-option {
        position: relative;
    }

    .estado-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .estado-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafafa;
        text-align: center;
        min-height: 90px;
    }

    .estado-option input[type="radio"]:checked + .estado-label {
        border-color: #1b4282;
        background: #e8f2ff;
    }

    .estado-label:hover {
        border-color: #5299d4;
        background: #f5f9ff;
    }

    .estado-icon {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .estado-text {
        font-weight: 600;
        font-size: 0.9rem;
        color: #555;
    }

    /* Estados con colores */
    .estado-pendiente .estado-icon { color: #f59e0b; }
    .estado-en_progreso .estado-icon { color: #3b82f6; }
    .estado-pausada .estado-icon { color: #f97316; }
    .estado-completada .estado-icon { color: #10b981; }
    .estado-cancelada .estado-icon { color: #ef4444; }

    /* Usuarios - Checkboxes visuales */
    .usuarios-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .usuario-option {
        position: relative;
    }

    .usuario-option input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .usuario-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .usuario-option input[type="checkbox"]:checked + .usuario-label {
        border-color: #1b4282;
        background: #e8f2ff;
    }

    .usuario-label:hover {
        border-color: #5299d4;
        background: #f5f9ff;
    }

    .usuario-checkbox-icon {
        width: 20px;
        height: 20px;
        border: 2px solid #d0d0d0;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .usuario-option input[type="checkbox"]:checked + .usuario-label .usuario-checkbox-icon {
        background: #1b4282;
        border-color: #1b4282;
    }

    .usuario-checkbox-icon i {
        color: white;
        font-size: 12px;
        display: none;
    }

    .usuario-option input[type="checkbox"]:checked + .usuario-label .usuario-checkbox-icon i {
        display: block;
    }

    .usuario-name {
        font-weight: 500;
        color: #555;
        font-size: 0.9rem;
    }

    .usuario-option input[type="checkbox"]:checked + .usuario-label .usuario-name {
        color: #1b4282;
        font-weight: 600;
    }

    .no-usuarios {
        text-align: center;
        padding: 2rem;
        color: #999;
        font-style: italic;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #e0e0e0;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(82, 153, 212, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
    }

    .btn-secondary {
        background: #f5f7fa;
        color: #555;
        border: 2px solid #e0e0e0;
    }

    .btn-secondary:hover {
        background: #e0e0e0;
        border-color: #d0d0d0;
    }

    /* Info card */
    .info-card {
        background: #f0f7ff;
        border: 2px solid #bde0ff;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        gap: 12px;
    }

    .info-card-icon {
        color: #1b4282;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .info-card-content strong {
        color: #1b4282;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .estado-options {
            grid-template-columns: repeat(2, 1fr);
        }

        .usuarios-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .form-container {
            padding: 1rem;
        }

        .estado-options {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

<div class="form-container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <div>
                <strong>Errores en el formulario:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Info de la tarea -->
    <div class="info-card">
        <i class="fas fa-info-circle info-card-icon"></i>
        <div class="info-card-content">
            <strong>Tarea:</strong> {{ $ocurrencia->tarea->nombre }}
            @if($ocurrencia->tarea->puntoVenta)
                <br><strong>Punto de Venta:</strong> {{ $ocurrencia->tarea->puntoVenta->nombre }}
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('ocurrencias.update', $ocurrencia) }}">
        @csrf
        @method('PUT')

        <!-- Información General -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-calendar-alt"></i>
                Información General
            </h3>

            <div class="form-group">
                <label class="form-label required">Fecha</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-calendar"></i></span>
                    <input 
                        type="date"
                        name="fecha"
                        class="form-control"
                        value="{{ old('fecha', $ocurrencia->fecha->format('Y-m-d')) }}"
                        required
                    >
                </div>
                <small class="form-hint">
                    <i class="fas fa-info-circle"></i>
                    Fecha en la que se debe realizar la tarea
                </small>
            </div>

            <div class="form-group">
                <label class="form-label required">Estado</label>
                <div class="estado-options">
                    <div class="estado-option">
                        <input 
                            type="radio" 
                            name="estado" 
                            value="pendiente" 
                            id="estado-pendiente"
                            {{ old('estado', $ocurrencia->estado) === 'pendiente' ? 'checked' : '' }}
                            required
                        >
                        <label for="estado-pendiente" class="estado-label estado-pendiente">
                            <i class="fas fa-clock estado-icon"></i>
                            <span class="estado-text">Pendiente</span>
                        </label>
                    </div>

                    <div class="estado-option">
                        <input 
                            type="radio" 
                            name="estado" 
                            value="en_progreso" 
                            id="estado-en_progreso"
                            {{ old('estado', $ocurrencia->estado) === 'en_progreso' ? 'checked' : '' }}
                        >
                        <label for="estado-en_progreso" class="estado-label estado-en_progreso">
                            <i class="fas fa-spinner estado-icon"></i>
                            <span class="estado-text">En Progreso</span>
                        </label>
                    </div>


                    <div class="estado-option">
                        <input 
                            type="radio" 
                            name="estado" 
                            value="completada" 
                            id="estado-completada"
                            {{ old('estado', $ocurrencia->estado) === 'completada' ? 'checked' : '' }}
                        >
                        <label for="estado-completada" class="estado-label estado-completada">
                            <i class="fas fa-check-circle estado-icon"></i>
                            <span class="estado-text">Completada</span>
                        </label>
                    </div>

                    <div class="estado-option">
                        <input 
                            type="radio" 
                            name="estado" 
                            value="cancelada" 
                            id="estado-cancelada"
                            {{ old('estado', $ocurrencia->estado) === 'cancelada' ? 'checked' : '' }}
                        >
                        <label for="estado-cancelada" class="estado-label estado-cancelada">
                            <i class="fas fa-times-circle estado-icon"></i>
                            <span class="estado-text">Cancelada</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usuarios Asignados -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-users"></i>
                Usuarios Asignados
            </h3>

            @if($usuarios->count())
                <div class="usuarios-grid">
                    @foreach ($usuarios as $user)
                        <div class="usuario-option">
                            <input 
                                type="checkbox" 
                                name="usuarios[]" 
                                value="{{ $user->id }}" 
                                id="usuario-{{ $user->id }}"
                                {{ $ocurrencia->usuarios->contains($user->id) ? 'checked' : '' }}
                            >
                            <label for="usuario-{{ $user->id }}" class="usuario-label">
                                <div class="usuario-checkbox-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="usuario-name">{{ $user->nombre }} {{ $user->primerApellido }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <small class="form-hint">
                    <i class="fas fa-info-circle"></i>
                    Selecciona los usuarios que realizarán esta tarea
                </small>
            @else
                <div class="no-usuarios">
                    <i class="fas fa-user-slash" style="font-size: 2rem; margin-bottom: 0.5rem; opacity: 0.5;"></i>
                    <p>No hay usuarios disponibles para asignar</p>
                </div>
            @endif
        </div>

        <!-- Acciones -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Guardar Cambios
            </button>
            <a href="{{ route('tareas.calendario') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection