@extends('layouts.app')

@section('title', 'Ver Reporte de Mantenimiento')

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

    .header-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .view-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        padding: 2.5rem 3rem;
        max-width: 1600px;
        margin: 0 auto;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-badge.completado {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.pendiente {
        background: #fff3cd;
        color: #856404;
    }

    .info-header {
        background: linear-gradient(135deg, #1b4282 0%, #2c5aa0 100%);
        color: white;
        border-radius: 10px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 12px rgba(27, 66, 130, 0.2);
    }

    .info-header-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .info-header-item {
        display: flex;
        flex-direction: column;
    }

    .info-header-label {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 0.25rem;
    }

    .info-header-value {
        font-size: 1.1rem;
        font-weight: 600;
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

    .data-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .data-item {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 1rem 1.25rem;
    }

    .data-label {
        font-size: 0.85rem;
        color: #666;
        font-weight: 600;
        margin-bottom: 0.4rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .data-label i {
        color: #1b4282;
        font-size: 0.9rem;
    }

    .data-value {
        font-size: 1rem;
        color: #2c3e50;
        font-weight: 500;
    }

    .data-value.large {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1b4282;
    }

    .text-block {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .text-block-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .text-block-content {
        color: #333;
        line-height: 1.6;
        white-space: pre-wrap;
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
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 0.75rem;
    }

    .check-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.5rem;
    }

    .check-icon {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .check-icon.checked {
        background: #28a745;
        color: white;
    }

    .check-icon.unchecked {
        background: #e0e0e0;
        color: #999;
    }

    .check-label {
        font-size: 0.95rem;
        color: #555;
    }

    .check-item.checked .check-label {
        color: #2c3e50;
        font-weight: 500;
    }

    /* Mediciones */
    .mediciones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .medicion-card {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 1.25rem;
    }

    .medicion-card.valid {
        border-color: #28a745;
        background: #f1f9f3;
    }

    .medicion-card.invalid {
        border-color: #dc3545;
        background: #fff5f5;
    }

    .medicion-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .medicion-parametros {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: #666;
    }

    .medicion-valores {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .medicion-valor-item {
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        padding: 0.75rem;
    }

    .medicion-valor-label {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 0.25rem;
    }

    .medicion-valor-value {
        font-size: 1.15rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .medicion-analisis {
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        padding: 1rem;
        font-size: 0.9rem;
        line-height: 1.5;
        color: #555;
    }

    .medicion-analisis.valid {
        border-color: #28a745;
        background: #f8fff9;
        color: #155724;
    }

    .medicion-analisis.invalid {
        border-color: #dc3545;
        background: #fff8f8;
        color: #721c24;
    }

    /* Usuarios */
    .usuarios-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }

    .usuario-item {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .usuario-icon {
        width: 40px;
        height: 40px;
        background: #1b4282;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .usuario-info {
        flex: 1;
    }

    .usuario-nombre {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    /* Firmas */
    .firmas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .firma-card {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 1.25rem;
        text-align: center;
    }

    .firma-image {
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        min-height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .firma-image img {
        max-width: 100%;
        max-height: 100px;
    }

    .firma-info {
        text-align: left;
    }

    .firma-nombre {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.25rem;
    }

    .firma-cedula {
        color: #666;
        font-size: 0.9rem;
    }

    /* Imágenes */
    .images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .image-card {
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .image-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .image-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .image-info {
        padding: 0.75rem;
        font-size: 0.85rem;
        color: #666;
        text-align: center;
    }

    .no-data-message {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        color: #999;
        font-size: 0.95rem;
    }

    .no-data-message i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        opacity: 0.5;
        display: block;
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

    .btn-success {
        background: #28a745;
        color: white;
        box-shadow: 0 3px 12px rgba(40, 167, 69, 0.3);
    }

    .btn-success:hover {
        background: #218838;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }

    /* Modal para imágenes */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        max-width: 90%;
        max-height: 90%;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    .modal-close:hover {
        color: #bbb;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .view-container {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.4rem;
        }

        .info-header-grid {
            grid-template-columns: 1fr;
        }

        .data-grid,
        .mediciones-grid,
        .firmas-grid,
        .images-grid {
            grid-template-columns: 1fr;
        }

        .header-actions {
            width: 100%;
        }

        .btn {
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
            Reporte de Mantenimiento #{{ $reporte->id }}
        </h1>
    </div>
    <div class="header-actions">
        <a href="{{ route('reportes.pdf', $reporte->id) }}" class="btn btn-success" target="_blank">
            <i class="fas fa-file-pdf"></i>
            Descargar PDF
        </a>
        <a href="{{ route('puntos-venta.reportes.index', $reporte->puntoVenta) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </div>
</div>

<div class="view-container">
    <!-- Información Principal -->
    <div class="info-header">
        <div class="info-header-grid">
            <div class="info-header-item">
                <div class="info-header-label">Punto de Venta</div>
                <div class="info-header-value">{{ $reporte->puntoVenta->nombre }}</div>
            </div>
            <div class="info-header-item">
                <div class="info-header-label">Tipo de Mantenimiento</div>
                <div class="info-header-value">{{ $reporte->tipoMantenimiento->nombre }}</div>
            </div>
            <div class="info-header-item">
                <div class="info-header-label">Fecha del Servicio</div>
                <div class="info-header-value">{{ \Carbon\Carbon::parse($reporte->fecha)->format('d/m/Y') }}</div>
            </div>
            <div class="info-header-item">
                <div class="info-header-label">Contrato</div>
                <div class="info-header-value">{{ $reporte->contrato }}</div>
            </div>
        </div>
    </div>

    <!-- Datos Generales del Mantenimiento -->
    <h3 class="section-title">
        <i class="fas fa-wrench"></i>
        Datos Generales del Mantenimiento
    </h3>

    <div class="data-grid">
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-water"></i>
                Tipo de Planta
            </div>
            <div class="data-value">{{ $reporte->tipoPlanta }}</div>
        </div>
    </div>

    <div class="text-block">
        <div class="text-block-label">Descripción del Mantenimiento</div>
        <div class="text-block-content">{{ $reporte->descripcion }}</div>
    </div>

    <!-- Datos del Equipo -->
    <h3 class="section-title">
        <i class="fas fa-cogs"></i>
        Datos del Equipo
    </h3>

    <div class="data-grid">
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-tag"></i>
                Marca
            </div>
            <div class="data-value">{{ $reporte->marca }}</div>
        </div>
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-barcode"></i>
                Modelo
            </div>
            <div class="data-value">{{ $reporte->modelo }}</div>
        </div>
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-hashtag"></i>
                Serie
            </div>
            <div class="data-value">{{ $reporte->serie }}</div>
        </div>
    </div>

    <!-- Checklist -->
    @if($reporte->checks && count($reporte->checks) > 0)
    <h3 class="section-title">
        <i class="fas fa-tasks"></i>
        Checklist de Mantenimiento
    </h3>

    @foreach($reporte->checks as $grupo => $items)
        <div class="checklist-group">
            <div class="checklist-group-title">
                <i class="fas fa-check-circle"></i>
                {{ Str::headline($grupo) }}
            </div>
            <div class="checklist-items">
                @foreach($items as $key => $value)
                    <div class="check-item {{ $value ? 'checked' : '' }}">
                        <div class="check-icon {{ $value ? 'checked' : 'unchecked' }}">
                            <i class="fas {{ $value ? 'fa-check' : 'fa-times' }}"></i>
                        </div>
                        <div class="check-label">{{ config("reportes.checks.{$grupo}.{$key}") }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    @endif

    <!-- Mediciones -->
    @if($reporte->mediciones && count($reporte->mediciones) > 0)
    <h3 class="section-title">
        <i class="fas fa-ruler-combined"></i>
        Mediciones y Ajustes
    </h3>

    <div class="mediciones-grid">
        @foreach($reporte->mediciones as $medicion)
            @php
                $parametro = $medicion->ajusteParametro;
                $esValido = false;
                
                if ($parametro && $medicion->medicionFinal !== null) {
                    if ($parametro->tipo === 'ENTRE') {
                        $esValido = $medicion->medicionFinal >= $parametro->primerValor && 
                                   $medicion->medicionFinal <= $parametro->segundoValor;
                    } elseif ($parametro->tipo === 'MAYOR_QUE') {
                        $esValido = $medicion->medicionFinal > $parametro->primerValor;
                    } elseif ($parametro->tipo === 'MENOR_QUE') {
                        $esValido = $medicion->medicionFinal < $parametro->primerValor;
                    }
                }
            @endphp
            
            <div class="medicion-card {{ $esValido ? 'valid' : 'invalid' }}">
                <div class="medicion-title">
                    <i class="fas {{ $esValido ? 'fa-check-circle' : 'fa-exclamation-triangle' }}"></i>
                    {{ $parametro->nombre ?? 'Parámetro Desconocido' }}
                </div>
                
                @if($parametro)
                <div class="medicion-parametros">
                    <strong>Parámetros de Validación:</strong>
                    @if($parametro->tipo === 'ENTRE')
                        Entre {{ $parametro->primerValor }} y {{ $parametro->segundoValor }}
                    @elseif($parametro->tipo === 'MAYOR_QUE')
                        Mayor que {{ $parametro->primerValor }}
                    @else
                        Menor que {{ $parametro->primerValor }}
                    @endif
                </div>
                @endif
                
                <div class="medicion-valores">
                    <div class="medicion-valor-item">
                        <div class="medicion-valor-label">Medición Inicial</div>
                        <div class="medicion-valor-value">{{ $medicion->medicionInicial ?? 'N/A' }}</div>
                    </div>
                    <div class="medicion-valor-item">
                        <div class="medicion-valor-label">Medición Final</div>
                        <div class="medicion-valor-value">{{ $medicion->medicionFinal ?? 'N/A' }}</div>
                    </div>
                </div>
                
                @if($medicion->analisisFuncionamiento)
                <div class="medicion-analisis {{ $esValido ? 'valid' : 'invalid' }}">
                    {{ $medicion->analisisFuncionamiento }}
                </div>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    <!-- Horario de Inspección -->
    <h3 class="section-title">
        <i class="fas fa-clock"></i>
        Horario de Inspección
    </h3>

    <div class="data-grid">
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-hourglass-start"></i>
                Hora Inicial
            </div>
            <div class="data-value">{{ \Carbon\Carbon::parse($reporte->horaInicial)->format('d/m/Y H:i') }}</div>
        </div>
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-hourglass-end"></i>
                Hora Final
            </div>
            <div class="data-value">{{ \Carbon\Carbon::parse($reporte->horaFinal)->format('d/m/Y H:i') }}</div>
        </div>
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-stopwatch"></i>
                Duración
            </div>
            <div class="data-value large">
                @php
                    $inicio = \Carbon\Carbon::parse($reporte->horaInicial);
                    $fin = \Carbon\Carbon::parse($reporte->horaFinal);
                    $diff = $inicio->diff($fin);
                @endphp
                {{ $diff->h }}h {{ $diff->i }}min
            </div>
        </div>
    </div>

    <!-- Usuarios de Inspección -->
    @if($reporte->usuarios && count($reporte->usuarios) > 0)
    <h3 class="section-title">
        <i class="fas fa-users"></i>
        Usuarios de Inspección ({{ count($reporte->usuarios) }})
    </h3>

    <div class="usuarios-list">
        @foreach($reporte->usuarios as $usuario)
        <div class="usuario-item">
            <div class="usuario-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="usuario-info">
                <div class="usuario-nombre">{{ $usuario->nombre }} {{ $usuario->primerApellido }}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Recomendaciones -->
    <h3 class="section-title">
        <i class="fas fa-lightbulb"></i>
        Recomendaciones
    </h3>

    <div class="text-block">
        <div class="text-block-content">{{ $reporte->recomendaciones }}</div>
    </div>

    <!-- Observaciones -->
    @if($reporte->observaciones)
    <h3 class="section-title">
        <i class="fas fa-comment"></i>
        Observaciones
    </h3>

    <div class="text-block">
        <div class="text-block-content">{{ $reporte->observaciones }}</div>
    </div>
    @endif

    <!-- Firmas -->
    @if($reporte->firmas && count($reporte->firmas) > 0)
    <h3 class="section-title">
        <i class="fas fa-signature"></i>
        Firmas
    </h3>

    <div class="firmas-grid">
        @foreach($reporte->firmas as $firma)
        <div class="firma-card">
            <div class="firma-image">
                @if($firma->firmaRuta)
                    <img src="{{ asset('storage/' . $firma->firmaRuta) }}" alt="Firma">
                @else
                    <i class="fas fa-signature" style="font-size: 3rem; color: #ccc;"></i>
                @endif
            </div>
            <div class="firma-info">
                <div class="firma-nombre">{{ $firma->nombreFirmante ?? 'Sin nombre' }}</div>
                <div class="firma-cedula">{{ $firma->cedulaFirmante ?? 'Sin cédula' }}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Costos -->
    <h3 class="section-title">
        <i class="fas fa-dollar-sign"></i>
        Información de Costos
    </h3>

    <div class="data-grid">
        @if($reporte->referencia)
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-receipt"></i>
                Referencia
            </div>
            <div class="data-value">{{ $reporte->referencia }}</div>
        </div>
        @endif
        <div class="data-item">
            <div class="data-label">
                <i class="fas fa-coins"></i>
                Costo Total
            </div>
            <div class="data-value large">₡{{ number_format($reporte->costoTotal, 2) }}</div>
        </div>
    </div>

    <!-- Imágenes -->
    @if($reporte->imagenes && count($reporte->imagenes) > 0)
    <h3 class="section-title">
        <i class="fas fa-images"></i>
        Evidencia Fotográfica ({{ count($reporte->imagenes) }})
    </h3>

    <div class="images-grid">
@foreach($reporte->imagenes as $imagen)

<div class="image-card"
     onclick="openModal(`{{ asset('storage/' . $imagen->imagenRuta) }}`)">

    <img src="{{ asset('storage/' . $imagen->imagenRuta) }}"
         alt="Imagen {{ $loop->iteration }}">

    <div class="image-info">
        Imagen {{ $loop->iteration }}
    </div>
</div>

@endforeach
</div>


    @else
    <h3 class="section-title">
        <i class="fas fa-images"></i>
        Evidencia Fotográfica
    </h3>
    <div class="no-data-message">
        <i class="fas fa-image"></i>
        <div>No se adjuntaron imágenes en este reporte</div>
    </div>
    @endif
</div>

<!-- Modal para imágenes -->
<div id="imageModal" class="modal">
    <span class="modal-close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
@endsection

@section('scripts')
<script>
function openModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.classList.add('active');
    modalImg.src = src;
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('active');
}

// Cerrar modal al hacer clic fuera de la imagen
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Cerrar modal con tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>
@endsection