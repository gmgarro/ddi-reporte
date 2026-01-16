@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.6rem;
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
        font-size: 0.95rem;
        color: #666;
        font-weight: 400;
        margin-top: 0.3rem;
    }

    .form-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .alert {
        padding: 0.875rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        display: flex;
        align-items: start;
        gap: 10px;
        border: none;
    }

    .alert-danger {
        background: #ffebee;
        color: #c62828;
    }

    .alert-icon {
        font-size: 1.1rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .alert ul {
        margin: 0.3rem 0 0 0;
        padding-left: 1.2rem;
    }

    .info-card {
        background: #f0f7ff;
        border: 2px solid #bde0ff;
        border-radius: 8px;
        padding: 0.875rem 1rem;
        margin-bottom: 1.25rem;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .info-card-icon {
        color: #1b4282;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .info-card-content strong {
        color: #1b4282;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #555;
        margin-bottom: 0.4rem;
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
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 15px;
        pointer-events: none;
        z-index: 1;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px 10px 38px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #fafafa;
        color: #333;
    }

    .form-control:focus {
        outline: none;
        border-color: #5299d4;
        background: white;
        box-shadow: 0 0 0 3px rgba(82, 153, 212, 0.1);
    }

    textarea.form-control {
        min-height: 80px;
        resize: vertical;
        font-family: inherit;
    }

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 35px;
    }

    .form-hint {
        font-size: 12px;
        color: #999;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    /* Días de la semana - más compacto */
    .dias-semana-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.4rem;
        margin-top: 0.5rem;
    }

    .dia-option {
        position: relative;
    }

    .dia-option input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .dia-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 0.25rem;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafafa;
        text-align: center;
        font-weight: 600;
        font-size: 0.8rem;
        color: #555;
    }

    .dia-option input[type="checkbox"]:checked + .dia-label {
        border-color: #1b4282;
        background: #e8f2ff;
        color: #1b4282;
    }

    .dia-label:hover {
        border-color: #5299d4;
        background: #f5f9ff;
    }

    /* Usuarios - grid simple */
    .usuarios-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.6rem;
        padding: 0.75rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        background: #fafafa;
        max-height: 300px;
        overflow-y: auto;
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
        gap: 8px;
        padding: 0.6rem 0.75rem;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        font-size: 0.875rem;
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
        width: 18px;
        height: 18px;
        border: 2px solid #d0d0d0;
        border-radius: 4px;
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
        font-size: 11px;
        display: none;
    }

    .usuario-option input[type="checkbox"]:checked + .usuario-label .usuario-checkbox-icon i {
        display: block;
    }

    .usuario-name {
        font-weight: 500;
        color: #555;
    }

    .usuario-option input[type="checkbox"]:checked + .usuario-label .usuario-name {
        color: #1b4282;
        font-weight: 600;
    }

    .usuarios-counter {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.5rem;
        font-weight: 600;
    }

    .no-usuarios {
        text-align: center;
        padding: 1.5rem;
        color: #999;
        font-style: italic;
    }

    .form-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e0e0e0;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
        color: white;
        box-shadow: 0 3px 12px rgba(82, 153, 212, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(82, 153, 212, 0.4);
    }

    .btn-primary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
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

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 1.25rem;
        }

        .page-title {
            font-size: 1.4rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .dias-semana-grid {
            grid-template-columns: repeat(4, 1fr);
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
</style>
@endsection

@section('content')

<div class="form-container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <div>
                <strong>Errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="info-card">
        <i class="fas fa-info-circle info-card-icon"></i>
        <div class="info-card-content">
            Editando tarea: <strong>{{ $tarea->nombre }}</strong>
        </div>
    </div>

    <form method="POST" action="{{ route('tareas.update', $tarea) }}" id="tareaForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="puntoVentaId" value="{{ $puntoVenta->id }}">
        
        <!-- Nombre -->
        <div class="form-group">
            <label class="form-label required">Nombre de la Tarea</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-tasks"></i></span>
                <input 
                    type="text"
                    name="nombre"
                    class="form-control"
                    value="{{ old('nombre', $tarea->nombre) }}"
                    placeholder="Ej: Mantenimiento de equipos"
                    required
                >
            </div>
        </div>

        <!-- Descripción -->
        <div class="form-group">
            <label class="form-label">Descripción</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-align-left"></i></span>
                <textarea 
                    name="descripcion"
                    class="form-control"
                    placeholder="Descripción de la tarea (opcional)..."
                >{{ old('descripcion', $tarea->descripcion) }}</textarea>
            </div>
        </div>

        <!-- Frecuencia (Select) -->
        <div class="form-group">
            <label class="form-label required">Frecuencia</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                <select name="frecuencia" id="frecuencia" class="form-control" required>
                    <option value="unica" {{ old('frecuencia', $tarea->frecuencia) === 'unica' ? 'selected' : '' }}>Única vez</option>
                    <option value="diaria" {{ old('frecuencia', $tarea->frecuencia) === 'diaria' ? 'selected' : '' }}>Diaria</option>
                    <option value="semanal" {{ old('frecuencia', $tarea->frecuencia) === 'semanal' ? 'selected' : '' }}>Semanal</option>
                    <option value="quincenal" {{ old('frecuencia', $tarea->frecuencia) === 'quincenal' ? 'selected' : '' }}>Quincenal</option>
                    <option value="mensual" {{ old('frecuencia', $tarea->frecuencia) === 'mensual' ? 'selected' : '' }}>Mensual</option>
                </select>
            </div>
        </div>

        <!-- Días de la semana (solo para semanal) -->
        <div class="form-group" id="dias_semana_container" style="display: none;">
            <label class="form-label required">Días de la Semana</label>
            <div class="dias-semana-grid">
                @php
                    $diasSemanaActuales = old('dias_semana', 
                        is_array($tarea->dias_semana) 
                            ? $tarea->dias_semana 
                            : ($tarea->dias_semana ? json_decode($tarea->dias_semana, true) : [])
                    );
                @endphp
                @foreach([
                    ['value' => '1', 'label' => 'L'],
                    ['value' => '2', 'label' => 'K'],
                    ['value' => '3', 'label' => 'M'],
                    ['value' => '4', 'label' => 'J'],
                    ['value' => '5', 'label' => 'V'],
                    ['value' => '6', 'label' => 'S'],
                    ['value' => '7', 'label' => 'D']
                ] as $dia)
                    <div class="dia-option">
                        <input type="checkbox" name="dias_semana[]" value="{{ $dia['value'] }}" 
                               id="dia-{{ $dia['value'] }}"
                               {{ is_array($diasSemanaActuales) && in_array($dia['value'], $diasSemanaActuales) ? 'checked' : '' }}>
                        <label for="dia-{{ $dia['value'] }}" class="dia-label">
                            {{ $dia['label'] }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Fechas -->
        <div class="form-row">
            <div class="form-group">
                <label class="form-label required" id="fecha_inicio_label">Fecha</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-calendar-check"></i></span>
                    <input 
                        type="date"
                        name="fecha_inicio"
                        id="fecha_inicio"
                        class="form-control"
                        value="{{ old('fecha_inicio', $tarea->fecha_inicio ? \Carbon\Carbon::parse($tarea->fecha_inicio)->format('Y-m-d') : '') }}"
                        required
                    >
                </div>
            </div>

            <div class="form-group" id="fecha_fin_container" style="display: none;">
                <label class="form-label required">Fecha de Fin</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-calendar-times"></i></span>
                    <input 
                        type="date"
                        name="fecha_fin"
                        id="fecha_fin"
                        class="form-control"
                        value="{{ old('fecha_fin', $tarea->fecha_fin ? \Carbon\Carbon::parse($tarea->fecha_fin)->format('Y-m-d') : '') }}"
                    >
                </div>
            </div>
        </div>

        <!-- Usuarios Asignados -->
        <div class="form-group">
            <label class="form-label required">Usuarios Asignados</label>
            
            @if($usuarios->count())
                @php
                    $usuariosAsignados = old('usuarios', $tarea->usuarios->pluck('id')->toArray());
                @endphp
                <div class="usuarios-grid">
                    @foreach ($usuarios as $user)
                        <div class="usuario-option">
                            <input 
                                type="checkbox" 
                                name="usuarios[]" 
                                value="{{ $user->id }}" 
                                id="usuario-{{ $user->id }}"
                                class="usuario-checkbox"
                                {{ is_array($usuariosAsignados) && in_array($user->id, $usuariosAsignados) ? 'checked' : '' }}
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

                <div class="usuarios-counter">
                    <i class="fas fa-user-check"></i>
                    <span id="usuariosCount">0</span> seleccionado(s)
                </div>
            @else
                <div class="no-usuarios">
                    <i class="fas fa-user-slash"></i> No hay usuarios disponibles
                </div>
            @endif
        </div>

        <!-- Acciones -->
        <div class="form-actions">
            <a href="{{ route('puntos-venta.tareas.index', $puntoVenta) }}" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                Cancelar
            </a>
            <button type="submit" class="btn btn-primary" id="submitBtn">
                <i class="fas fa-save"></i>
                Actualizar Tarea
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const frecuenciaSelect = document.getElementById('frecuencia');
    const diasContainer = document.getElementById('dias_semana_container');
    const fechaInicioLabel = document.getElementById('fecha_inicio_label');
    const fechaFinContainer = document.getElementById('fecha_fin_container');
    const fechaFinInput = document.getElementById('fecha_fin');
    const usuariosCheckboxes = document.querySelectorAll('.usuario-checkbox');
    const usuariosCount = document.getElementById('usuariosCount');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('tareaForm');

    // Manejar cambio de frecuencia
    function actualizarCamposFrecuencia() {
        const frecuencia = frecuenciaSelect.value;
        
        // Mostrar/ocultar días de la semana
        diasContainer.style.display = frecuencia === 'semanal' ? 'block' : 'none';

        // Manejar fechas
        if (frecuencia === 'unica') {
            fechaInicioLabel.textContent = 'Fecha';
            fechaFinContainer.style.display = 'none';
            fechaFinInput.removeAttribute('required');
        } else {
            fechaInicioLabel.textContent = 'Fecha de Inicio';
            fechaFinContainer.style.display = 'block';
            fechaFinInput.setAttribute('required', 'required');
        }
    }

    frecuenciaSelect.addEventListener('change', actualizarCamposFrecuencia);

    // Inicializar al cargar la página
    actualizarCamposFrecuencia();

    // Contador de usuarios
    function actualizarContador() {
        const count = document.querySelectorAll('.usuario-checkbox:checked').length;
        usuariosCount.textContent = count;
        
        if (count === 0) {
            submitBtn.setAttribute('disabled', 'disabled');
            submitBtn.style.opacity = '0.5';
        } else {
            submitBtn.removeAttribute('disabled');
            submitBtn.style.opacity = '1';
        }
    }

    usuariosCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', actualizarContador);
    });

    // Inicializar contador
    actualizarContador();

    // Validación
    form.addEventListener('submit', function(e) {
        const frecuencia = frecuenciaSelect.value;
        const usuariosSeleccionados = document.querySelectorAll('.usuario-checkbox:checked').length;

        if (usuariosSeleccionados === 0) {
            e.preventDefault();
            alert('Debe seleccionar al menos un usuario');
            return false;
        }

        if (frecuencia === 'semanal') {
            const diasSeleccionados = document.querySelectorAll('input[name="dias_semana[]"]:checked').length;
            if (diasSeleccionados === 0) {
                e.preventDefault();
                alert('Debe seleccionar al menos un día de la semana');
                return false;
            }
        }

        if (frecuencia !== 'unica' && !fechaFinInput.value) {
            e.preventDefault();
            alert('La fecha de fin es obligatoria para tareas recurrentes');
            return false;
        }

        return true;
    });
</script>
@endsection