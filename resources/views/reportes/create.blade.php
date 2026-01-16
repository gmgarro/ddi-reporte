@extends('layouts.app')

@section('title', 'Crear Reporte de Mantenimiento')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
        max-width: 1600px;
        margin-left: auto;
        margin-right: auto;
        padding: 0 1rem;
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
        padding: 2.5rem 3rem;
        max-width: 1600px;
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
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .info-card-icon {
        color: #1b4282;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .info-card-content strong {
        color: #1b4282;
        font-weight: 600;
        font-size: 15px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 2rem 0 1.25rem;
        padding-bottom: 0.65rem;
        border-bottom: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #1b4282;
        font-size: 1.15rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 15px;
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
        padding: 12px 14px 12px 42px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
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
        min-height: 100px;
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
        gap: 1.5rem;
    }

    .form-row-3 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .form-row-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    /* Checklist */
    .checklist-group {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 1.25rem;
        margin-bottom: 1.25rem;
    }

    .checklist-group-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .checklist-items {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
    }

    .check-option {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .check-option input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #1b4282;
    }

    .check-option label {
        cursor: pointer;
        font-size: 0.95rem;
        color: #555;
        margin: 0;
    }

    /* Mediciones */
    .mediciones-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .medicion-card {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 1.25rem;
    }

    .medicion-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .medicion-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }

    .medicion-input-group label {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.35rem;
        display: block;
        font-weight: 600;
    }

    .usuarios-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
        padding: 1.25rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        background: #fafafa;
        max-height: 400px;
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
        gap: 10px;
        padding: 0.75rem 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        font-size: 0.95rem;
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
        font-size: 12px;
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
        font-size: 0.9rem;
        color: #666;
        margin-top: 0.75rem;
        font-weight: 600;
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
        border-radius: 8px;
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
        background: #1b4282;
        color: white;
        box-shadow: 0 3px 12px rgba(27, 66, 130, 0.3);
    }

    .btn-primary:hover {
        background: #2c5aa0;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(27, 66, 130, 0.4);
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
    @media (max-width: 1200px) {
        .form-row-4 {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .mediciones-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .checklist-items {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.4rem;
        }

        .form-row,
        .form-row-3,
        .form-row-4 {
            grid-template-columns: 1fr;
        }

        .checklist-items {
            grid-template-columns: 1fr;
        }

        .mediciones-grid {
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
<div class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fas fa-file-alt"></i>
            Crear Reporte de Mantenimiento
        </h1>
        <p class="page-subtitle">Complete la información del servicio realizado</p>
    </div>
</div>

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
        <i class="fas fa-map-marker-alt info-card-icon"></i>
        <div class="info-card-content">
            <strong>Punto de venta:</strong> {{ $puntoVenta->nombre }}
        </div>
    </div>

    <form action="{{ route('reportes.store') }}" method="POST" enctype="multipart/form-data" id="formReporte">
        @csrf
        <input type="hidden" name="puntoVentaId" value="{{ $puntoVenta->id }}">

        <!-- Departamento de Mantenimiento -->
        <h3 class="section-title">
            <i class="fas fa-building"></i>
            Departamento de Mantenimiento
        </h3>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Contrato</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-file-contract"></i></span>
                    <input type="text" name="contrato" class="form-control" value="{{ old('contrato') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label required">Fecha</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-calendar"></i></span>
                    <input type="date" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
                </div>
            </div>
        </div>

        <!-- Datos Generales del Mantenimiento -->
        <h3 class="section-title">
            <i class="fas fa-wrench"></i>
            Datos Generales del Mantenimiento
        </h3>

        <div class="form-row-3">
            <div class="form-group">
                <label class="form-label required">Tipo de Mantenimiento</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-tools"></i></span>
                    <select name="tipoMantenimientoId" id="tipoMantenimiento" class="form-control" required>
                        <option value="">Seleccione un tipo</option>
                        @foreach($tiposMantenimiento as $tipo)
                            <option value="{{ $tipo->id }}" data-nombre="{{ strtolower($tipo->nombre) }}" {{ old('tipoMantenimientoId') == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label required">Tipo de Planta</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-water"></i></span>
                    <select name="tipoPlantaSelect" id="tipoPlantaSelect" class="form-control" required>
                        <option value="">Seleccione un tipo</option>
                        <option value="Aerobia" {{ old('tipoPlantaSelect') == 'Aerobia' ? 'selected' : '' }}>Aerobia</option>
                        <option value="Anaerobia" {{ old('tipoPlantaSelect') == 'Anaerobia' ? 'selected' : '' }}>Anaerobia</option>
                        <option value="Tanque Séptico" {{ old('tipoPlantaSelect') == 'Tanque Séptico' ? 'selected' : '' }}>Tanque Séptico</option>
                        <option value="Otro" {{ old('tipoPlantaSelect') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>
            </div>

            <div class="form-group" id="tipoPlantaOtroContainer" style="display: none;">
                <label class="form-label required">Especifique Tipo de Planta</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-pen"></i></span>
                    <input type="text" name="tipoPlantaOtro" id="tipoPlantaOtro" class="form-control" value="{{ old('tipoPlantaOtro') }}" placeholder="Especifique el tipo de planta">
                </div>
            </div>
        </div>

        <input type="hidden" name="tipoPlanta" id="tipoPlantaHidden" value="{{ old('tipoPlanta') }}">

        <div class="form-group">
            <label class="form-label required">Descripción</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-align-left"></i></span>
                <textarea name="descripcion" class="form-control" required>{{ old('descripcion') }}</textarea>
            </div>
        </div>

        <!-- Datos del Equipo -->
        <h3 class="section-title">
            <i class="fas fa-cogs"></i>
            Datos del Equipo
        </h3>

        <div class="form-row-3">
            <div class="form-group">
                <label class="form-label required">Marca</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-tag"></i></span>
                    <input type="text" name="marca" class="form-control" value="{{ old('marca') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label required">Modelo</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-barcode"></i></span>
                    <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label required">Serie</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-hashtag"></i></span>
                    <input type="text" name="serie" class="form-control" value="{{ old('serie') }}" required>
                </div>
            </div>
        </div>

        <!-- Checklist (solo para preventivo) -->
        <div id="seccionChecklist" style="display: none;">
            <h3 class="section-title">
                <i class="fas fa-tasks"></i>
                Checklist de Mantenimiento
            </h3>

            @php
                $checksConfig = config('reportes.checks');
            @endphp

            @foreach($checksConfig as $grupo => $checks)
                <div class="checklist-group">
                    <div class="checklist-group-title">
                        <i class="fas fa-check-circle"></i>
                        {{ Str::headline($grupo) }}
                    </div>
                    <div class="checklist-items">
                        @foreach($checks as $key => $label)
                            <div class="check-option">
                                <input type="checkbox" 
                                       name="checks[{{ $grupo }}][{{ $key }}]" 
                                       value="1"
                                       id="check_{{ $grupo }}_{{ $key }}"
                                       {{ old("checks.{$grupo}.{$key}") ? 'checked' : '' }}>
                                <label for="check_{{ $grupo }}_{{ $key }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Mediciones (solo para preventivo) -->
        <div id="seccionMediciones" style="display: none;">
            <h3 class="section-title">
                <i class="fas fa-ruler-combined"></i>
                Mediciones y Ajustes
            </h3>

            @if($ajustesParametros->count() > 0)
                <div class="mediciones-grid">
                    @foreach($ajustesParametros as $parametro)
                        <div class="medicion-card">
                            <div class="medicion-title">{{ $parametro->nombre }}</div>
                            <input type="hidden" 
                                   name="mediciones[{{ $loop->index }}][ajusteParametroId]" 
                                   value="{{ $parametro->id }}">
                            
                            <input type="hidden" 
                                   name="mediciones[{{ $loop->index }}][tipo]" 
                                   value="{{ $parametro->tipo }}">
                            
                            <input type="hidden" 
                                   name="mediciones[{{ $loop->index }}][primerValor]" 
                                   value="{{ $parametro->primerValor }}">
                            
                            <input type="hidden" 
                                   name="mediciones[{{ $loop->index }}][segundoValor]" 
                                   value="{{ $parametro->segundoValor ?? '' }}">
                            
                            <div class="form-group" style="margin-bottom: 0.75rem;">
                                <label style="font-size: 0.85rem; color: #666; margin-bottom: 0.35rem; display: block; font-weight: 600;">
                                    Parámetros de Validación
                                </label>
                                <input type="text" 
                                       class="form-control parametros-info"
                                       style="padding: 8px 12px; font-size: 0.95rem; background: #f0f0f0;"
                                       value="{{ $parametro->tipo === 'ENTRE' ? 'Entre ' . $parametro->primerValor . ' y ' . $parametro->segundoValor : ($parametro->tipo === 'MAYOR_QUE' ? 'Mayor que ' . $parametro->primerValor : 'Menor que ' . $parametro->primerValor) }}"
                                       readonly>
                            </div>
                            
                            <div class="medicion-inputs">
                                <div class="medicion-input-group">
                                    <label>Inicial</label>
                                    <input type="number" 
                                           step="0.01" 
                                           name="mediciones[{{ $loop->index }}][medicionInicial]"
                                           class="medicion-value-input"
                                           style="width: 100%; padding: 8px 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 0.95rem; background: white;"
                                           data-index="{{ $loop->index }}"
                                           value="{{ old("mediciones.{$loop->index}.medicionInicial") }}">
                                </div>
                                
                                <div class="medicion-input-group">
                                    <label>Final</label>
                                    <input type="number" 
                                           step="0.01" 
                                           name="mediciones[{{ $loop->index }}][medicionFinal]"
                                           class="medicion-value-input medicion-final"
                                           style="width: 100%; padding: 8px 12px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 0.95rem; background: white;"
                                           data-index="{{ $loop->index }}"
                                           data-tipo="{{ $parametro->tipo }}"
                                           data-primer-valor="{{ $parametro->primerValor }}"
                                           data-segundo-valor="{{ $parametro->segundoValor ?? '' }}"
                                           value="{{ old("mediciones.{$loop->index}.medicionFinal") }}">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 0.75rem; margin-bottom: 0;">
                                <label style="font-size: 0.85rem; color: #666; margin-bottom: 0.35rem; display: block; font-weight: 600;">Análisis de Funcionamiento</label>
                                <textarea name="mediciones[{{ $loop->index }}][analisisFuncionamiento]"
                                          class="form-control analisis-funcionamiento"
                                          id="analisis_{{ $loop->index }}"
                                          style="padding: 8px 12px; font-size: 0.95rem; min-height: 75px;"
                                          readonly>{{ old("mediciones.{$loop->index}.analisisFuncionamiento") }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="info-card">
                    <i class="fas fa-info-circle info-card-icon"></i>
                    <div class="info-card-content">
                        No hay parámetros de ajuste configurados
                    </div>
                </div>
            @endif
        </div>

        <!-- Usuarios de Inspección -->
        <h3 class="section-title">
            <i class="fas fa-clock"></i>
            Tiempo de inspección
        </h3>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label required">Hora Inicial</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-hourglass-start"></i></span>
                    <input type="datetime-local" name="horaInicial" class="form-control" value="{{ old('horaInicial') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label required">Hora Final</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-hourglass-end"></i></span>
                    <input type="datetime-local" name="horaFinal" class="form-control" value="{{ old('horaFinal') }}" required>
                </div>
            </div>
        </div>

        <!-- Recomendaciones -->
        <h3 class="section-title">
            <i class="fas fa-lightbulb"></i>
            Recomendaciones
        </h3>

        <div class="form-group">
            <label class="form-label required">Recomendaciones</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-clipboard-list"></i></span>
                <textarea name="recomendaciones" class="form-control" required>{{ old('recomendaciones') }}</textarea>
            </div>
            <div class="form-hint">
                <i class="fas fa-info-circle"></i>
                Incluya recomendaciones para el mantenimiento futuro
            </div>
        </div>

        <!-- Firma y Observaciones -->
        <h3 class="section-title">
            <i class="fas fa-signature"></i>
            Firma y Observaciones
        </h3>

        <div class="form-row-4">
            <div class="form-group">
                <label class="form-label">Nombre del Firmante</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="firmas[0][nombreFirmante]" class="form-control" value="{{ old('firmas.0.nombreFirmante') }}" placeholder="Nombre completo">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Cédula del Firmante</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-id-card"></i></span>
                    <input type="text" name="firmas[0][cedulaFirmante]" class="form-control" value="{{ old('firmas.0.cedulaFirmante') }}" placeholder="Número de cédula">
                </div>
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label class="form-label">Imágenes del Servicio</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-camera"></i></span>
                    <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*">
                </div>
                <div class="form-hint">
                    <i class="fas fa-info-circle"></i>
                    Puede seleccionar múltiples imágenes
                </div>
            </div>
        </div>

        <input type="hidden" name="firmas[0][firmaRuta]" value="firmas/firma1.png">

        <div class="form-group">
            <label class="form-label">Observaciones</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-comment"></i></span>
                <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
            </div>
            <div class="form-hint">
                <i class="fas fa-info-circle"></i>
                Cualquier observación adicional sobre el servicio
            </div>
        </div>

        <!-- Usuarios de Inspección -->
        <h3 class="section-title">
            <i class="fas fa-users"></i>
            Usuarios de Inspección
        </h3>

        <div class="form-group">
            <label class="form-label required">Usuarios Asignados</label>
            
            @if($usuarios->count())
                <div class="usuarios-grid">
                    @foreach ($usuarios as $user)
                        <div class="usuario-option">
                            <input 
                                type="checkbox" 
                                name="usuarios[]" 
                                value="{{ $user->id }}" 
                                id="usuario-{{ $user->id }}"
                                class="usuario-checkbox"
                                {{ is_array(old('usuarios')) && in_array($user->id, old('usuarios')) ? 'checked' : '' }}
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
                <div class="info-card">
                    <i class="fas fa-user-slash info-card-icon"></i>
                    <div class="info-card-content">No hay usuarios disponibles</div>
                </div>
            @endif
        </div>

        <!-- Costos y Referencia -->
        <h3 class="section-title">
            <i class="fas fa-dollar-sign"></i>
            Costos y Referencia
        </h3>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Referencia</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-receipt"></i></span>
                    <input type="text" name="referencia" class="form-control" value="{{ old('referencia') }}" placeholder="Número de factura o referencia">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Costo Total</label>
                <div class="input-wrapper">
                    <span class="input-icon">₡</span>
                    <input type="number" step="0.01" name="costoTotal" class="form-control" value="{{ old('costoTotal', '0') }}">
                </div>
            </div>
        </div>

        <!-- Imágenes -->
        <h3 class="section-title">
            <i class="fas fa-images"></i>
            Evidencia Fotográfica
        </h3>

        <div class="form-group">
            <label class="form-label">Imágenes del Servicio</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-camera"></i></span>
                <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*">
            </div>
            <div class="form-hint">
                <i class="fas fa-info-circle"></i>
                Puede seleccionar múltiples imágenes
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="form-actions">
            <a href="{{ route('puntos-venta.reportes.index', $puntoVenta) }}" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Guardar Reporte
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoMantenimientoSelect = document.getElementById('tipoMantenimiento');
    const seccionChecklist = document.getElementById('seccionChecklist');
    const seccionMediciones = document.getElementById('seccionMediciones');
    const tipoPlantaSelect = document.getElementById('tipoPlantaSelect');
    const tipoPlantaOtroContainer = document.getElementById('tipoPlantaOtroContainer');
    const tipoPlantaOtroInput = document.getElementById('tipoPlantaOtro');
    const tipoPlantaHidden = document.getElementById('tipoPlantaHidden');
    const usuariosCheckboxes = document.querySelectorAll('.usuario-checkbox');
    const usuariosCount = document.getElementById('usuariosCount');

    // Tipos que NO muestran checklist ni mediciones
    const tiposNoPreventivos = ['correctivo', 'emergencia', 'mejora de infraestructura', 'reemplazo'];

    // Mostrar/ocultar secciones según tipo de mantenimiento
    function actualizarSecciones() {
        const selectedOption = tipoMantenimientoSelect.options[tipoMantenimientoSelect.selectedIndex];
        const nombreTipo = selectedOption.getAttribute('data-nombre') || '';
        const esNoPreventivo = tiposNoPreventivos.some(tipo => nombreTipo.includes(tipo));

        if (esNoPreventivo) {
            seccionChecklist.style.display = 'none';
            seccionMediciones.style.display = 'none';
        } else {
            seccionChecklist.style.display = 'block';
            seccionMediciones.style.display = 'block';
        }
    }

    tipoMantenimientoSelect.addEventListener('change', actualizarSecciones);
    if (tipoMantenimientoSelect.value) {
        actualizarSecciones();
    }

    // Manejar tipo de planta
    function actualizarTipoPlanta() {
        const valorSeleccionado = tipoPlantaSelect.value;
        
        if (valorSeleccionado === 'Otro') {
            tipoPlantaOtroContainer.style.display = 'block';
            tipoPlantaOtroInput.setAttribute('required', 'required');
            tipoPlantaHidden.value = tipoPlantaOtroInput.value;
        } else {
            tipoPlantaOtroContainer.style.display = 'none';
            tipoPlantaOtroInput.removeAttribute('required');
            tipoPlantaHidden.value = valorSeleccionado;
        }
    }

    tipoPlantaSelect.addEventListener('change', actualizarTipoPlanta);
    tipoPlantaOtroInput.addEventListener('input', function() {
        tipoPlantaHidden.value = this.value;
    });

    actualizarTipoPlanta();

    // Contador de usuarios
    function actualizarContador() {
        const count = document.querySelectorAll('.usuario-checkbox:checked').length;
        if (usuariosCount) {
            usuariosCount.textContent = count;
        }
    }

    usuariosCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', actualizarContador);
    });

    actualizarContador();

    // Análisis automático de funcionamiento basado en parámetros
    const medicionInputs = document.querySelectorAll('.medicion-final');
    
    function validarYAnalizar(input) {
        const index = input.getAttribute('data-index');
        const tipo = input.getAttribute('data-tipo');
        const primerValor = parseFloat(input.getAttribute('data-primer-valor'));
        const segundoValor = input.getAttribute('data-segundo-valor') ? parseFloat(input.getAttribute('data-segundo-valor')) : null;
        const medicionFinal = parseFloat(input.value);
        const analisisTextarea = document.getElementById(`analisis_${index}`);
        
        if (!analisisTextarea || isNaN(medicionFinal)) {
            if (analisisTextarea) analisisTextarea.value = '';
            return;
        }
        
        let analisis = '';
        let cumpleParametros = false;
        
        // Validar según el tipo
        if (tipo === 'ENTRE') {
            cumpleParametros = medicionFinal >= primerValor && medicionFinal <= segundoValor;
            
            if (cumpleParametros) {
                analisis = `✓ NORMAL: La medición final (${medicionFinal}) se encuentra dentro del rango esperado (${primerValor} - ${segundoValor}). El sistema está funcionando correctamente según los parámetros establecidos.`;
            } else {
                if (medicionFinal < primerValor) {
                    const diferencia = primerValor - medicionFinal;
                    analisis = `✗ FUERA DE RANGO: La medición final (${medicionFinal}) está ${diferencia.toFixed(2)} unidades por DEBAJO del rango mínimo (${primerValor}). Se requiere inspección del sistema.`;
                } else {
                    const diferencia = medicionFinal - segundoValor;
                    analisis = `✗ FUERA DE RANGO: La medición final (${medicionFinal}) está ${diferencia.toFixed(2)} unidades por ENCIMA del rango máximo (${segundoValor}). Se requiere inspección del sistema.`;
                }
            }
        } else if (tipo === 'MAYOR_QUE') {
            cumpleParametros = medicionFinal > primerValor;
            
            if (cumpleParametros) {
                const diferencia = medicionFinal - primerValor;
                analisis = `✓ NORMAL: La medición final (${medicionFinal}) es mayor que el valor mínimo requerido (${primerValor}). Diferencia: +${diferencia.toFixed(2)} unidades. Sistema operando correctamente.`;
            } else {
                const diferencia = primerValor - medicionFinal;
                analisis = `✗ ADVERTENCIA: La medición final (${medicionFinal}) NO cumple con el valor mínimo requerido (${primerValor}). Está ${diferencia.toFixed(2)} unidades por debajo. Se requiere ajuste inmediato.`;
            }
        } else if (tipo === 'MENOR_QUE') {
            cumpleParametros = medicionFinal < primerValor;
            
            if (cumpleParametros) {
                const diferencia = primerValor - medicionFinal;
                analisis = `✓ NORMAL: La medición final (${medicionFinal}) es menor que el valor máximo permitido (${primerValor}). Diferencia: -${diferencia.toFixed(2)} unidades. Sistema operando correctamente.`;
            } else {
                const diferencia = medicionFinal - primerValor;
                analisis = `✗ ADVERTENCIA: La medición final (${medicionFinal}) EXCEDE el valor máximo permitido (${primerValor}). Está ${diferencia.toFixed(2)} unidades por encima. Se requiere ajuste inmediato.`;
            }
        }
        
        analisisTextarea.value = analisis;
        
        // Cambiar color del borde según validación
        if (cumpleParametros) {
            input.style.borderColor = '#28a745';
        } else {
            input.style.borderColor = '#dc3545';
        }
    }
    
    medicionInputs.forEach(input => {
        input.addEventListener('input', function() {
            validarYAnalizar(this);
        });
        
        // Validar al cargar si hay valor
        if (input.value) {
            validarYAnalizar(input);
        }
    });

    // Calcular duración automáticamente
    const horaInicial = document.querySelector('input[name="horaInicial"]');
    const horaFinal = document.querySelector('input[name="horaFinal"]');
    const duracionCalculada = document.getElementById('duracionCalculada');

    function calcularDuracion() {
        if (horaInicial.value && horaFinal.value) {
            const inicio = new Date(horaInicial.value);
            const fin = new Date(horaFinal.value);
            
            const diffMs = fin - inicio;
            
            if (diffMs > 0) {
                const diffHrs = Math.floor(diffMs / 3600000);
                const diffMins = Math.floor((diffMs % 3600000) / 60000);
                
                duracionCalculada.value = `${diffHrs}h ${diffMins}min`;
            } else {
                duracionCalculada.value = 'Hora final debe ser mayor';
            }
        } else {
            duracionCalculada.value = '';
        }
    }

    horaInicial.addEventListener('change', calcularDuracion);
    horaFinal.addEventListener('change', calcularDuracion);
});
</script>
@endsection