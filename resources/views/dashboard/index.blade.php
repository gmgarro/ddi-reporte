@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-title i {
        color: #1b4282;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 1rem;
        margin: 0;
    }

    /* KPI Cards */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .kpi-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
    }

    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .kpi-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .kpi-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .kpi-icon.blue {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        color: #1976d2;
    }

    .kpi-icon.green {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        color: #388e3c;
    }

    .kpi-icon.purple {
        background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
        color: #7b1fa2;
    }

    .kpi-content {
        flex: 1;
        text-align: right;
    }

    .kpi-label {
        font-size: 0.875rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .kpi-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1;
    }

    /* Mapa */
    .map-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
    }

    .map-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .map-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .map-title i {
        color: #1b4282;
    }

    .map-legend {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
        color: #555;
    }

    .legend-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .legend-icon.punto-venta {
        background: #1b4282;
    }

    .legend-icon.empleado {
        background: #c62828;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(198, 40, 40, 0.4);
    }

    #map {
        height: 600px;
        width: 100%;
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        z-index: 1;
    }

    /* Custom Leaflet Popup - Sobrescribir Bootstrap */
    .leaflet-popup-content-wrapper {
        border-radius: 12px !important;
        padding: 0 !important;
        overflow: visible !important;
    }

    .leaflet-popup-content {
        margin: 0 !important;
        min-width: 250px !important;
        width: auto !important;
    }

    .leaflet-popup-tip-container {
        overflow: visible !important;
    }

    .leaflet-popup {
        z-index: 1000 !important;
    }

    .popup-header {
        background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        color: white;
        padding: 12px 15px;
        font-weight: 600;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: default;
        border-radius: 12px 12px 0 0;
    }

    .popup-header.empleado {
        background: linear-gradient(135deg, #c62828 0%, #e57373 100%);
    }

    .popup-body {
        padding: 15px;
        background: white;
    }

    .popup-row {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 10px;
        font-size: 14px;
        line-height: 1.4;
    }

    .popup-row:last-child {
        margin-bottom: 0;
    }

    .popup-row i {
        color: #1b4282;
        width: 16px;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .popup-row.empleado i {
        color: #c62828;
    }

    .popup-label {
        font-weight: 600;
        color: #555;
    }

    .popup-value {
        color: #666;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }

        .kpi-grid {
            grid-template-columns: 1fr;
        }

        .kpi-value {
            font-size: 2rem;
        }

        #map {
            height: 400px;
        }

        .map-legend {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-chart-line"></i>
        Panel Administrativo
    </h1>
    <p class="page-subtitle">Bienvenido, {{ auth()->user()->nombre }}</p>
</div>

{{-- KPIs --}}
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-header">
            <div class="kpi-icon blue">
                <i class="fas fa-store"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">Puntos de Servicio</div>
                <div class="kpi-value">{{ $puntosVenta->count() }}</div>
            </div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-header">
            <div class="kpi-icon green">
                <i class="fas fa-users"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">Empleados Activos</div>
                <div class="kpi-value">{{ $empleadosConUbicacion->count() }}</div>
            </div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-header">
            <div class="kpi-icon purple">
                <i class="fas fa-building"></i>
            </div>
            <div class="kpi-content">
                <div class="kpi-label">Clientes Registrados</div>
                <div class="kpi-value">{{ $clientesRegistrados }}</div>
            </div>
        </div>
    </div>
</div>

{{-- MAPA --}}
<div class="map-container">
    <div class="map-header">
        <h2 class="map-title">
            <i class="fas fa-map-marked-alt"></i>
            Mapa de Ubicaciones
        </h2>
        <div class="map-legend">
            <div class="legend-item">
                <div class="legend-icon punto-venta"></div>
                <span>Puntos de Servicio</span>
            </div>
            <div class="legend-item">
                <div class="legend-icon empleado"></div>
                <span>Empleados en Tiempo Real</span>
            </div>
        </div>
    </div>
    <div id="map"></div>
</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Inicializar mapa (Costa Rica)
    const map = L.map('map').setView([9.9333, -84.0833], 7);

    // Capa base con mejor estilo
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // =========================
    // PUNTOS DE VENTA
    // =========================
    const puntosVenta = @json($puntosVenta);

    console.log('Puntos de venta:', puntosVenta);

    // Icono personalizado para puntos de venta
    const puntoVentaIcon = L.divIcon({
        className: 'custom-marker',
        html: `
            <div style="
                width: 32px;
                height: 32px;
                background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
                border: 3px solid white;
                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(27, 66, 130, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 16px;
            ">
                <i class="fas fa-store"></i>
            </div>
        `,
        iconSize: [32, 32],
        iconAnchor: [16, 16],
        popupAnchor: [0, -16]
    });

    puntosVenta.forEach(pv => {
        if (!pv.latitud || !pv.longitud) return;

        const marker = L.marker([pv.latitud, pv.longitud], {
            icon: puntoVentaIcon
        }).addTo(map);

        const popup = `
            <div class="popup-header">
                <i class="fas fa-store"></i>
                Punto de Servicio
            </div>
            <div class="popup-body">
                <div class="popup-row">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <div class="popup-label">${pv.nombre}</div>
                    </div>
                </div>
                <div class="popup-row">
                    <i class="fas fa-building"></i>
                    <div>
                        <span class="popup-label">Cliente:</span>
                        <span class="popup-value">${pv.cliente ? pv.cliente.nombre : 'No asignado'}</span>
                    </div>
                </div>
                <div class="popup-row">
                    <i class="fas fa-map-pin"></i>
                    <div>
                        <span class="popup-label">Provincia:</span>
                        <span class="popup-value">${pv.provincia ? pv.provincia.nombre : 'No especificada'}</span>
                    </div>
                </div>
            </div>
        `;

        marker.bindPopup(popup, {
            maxWidth: 300,
            className: 'custom-popup'
        });
    });

    // =========================
    // EMPLEADOS EN TIEMPO REAL
    // =========================
    const empleados = @json($empleadosConUbicacion);

    console.log('Empleados con ubicación:', empleados);

    // Icono personalizado para empleados
    const empleadoIcon = L.divIcon({
        className: 'custom-marker-empleado',
        html: `
            <div style="
                width: 32px;
                height: 32px;
                background: linear-gradient(135deg, #c62828 0%, #e57373 100%);
                border: 3px solid white;
                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(198, 40, 40, 0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 16px;
            ">
                <i class="fas fa-user"></i>
            </div>
        `,
        iconSize: [32, 32],
        iconAnchor: [16, 16],
        popupAnchor: [0, -16]
    });

    empleados.forEach((emp, index) => {
        console.log(`Procesando empleado ${index}:`, emp);
        
        if (!emp.latitud || !emp.longitud) {
            console.log(`Empleado ${index} no tiene coordenadas válidas`);
            return;
        }

        console.log(`Creando marcador para empleado en: [${emp.latitud}, ${emp.longitud}]`);

        const marker = L.marker([parseFloat(emp.latitud), parseFloat(emp.longitud)], {
            icon: empleadoIcon,
            riseOnHover: true
        }).addTo(map);

        // Formatear fecha de actualización
        let fechaFormateada = 'No disponible';
        if (emp.horaActualizacion) {
            try {
                const fechaActualizacion = new Date(emp.horaActualizacion);
                fechaFormateada = fechaActualizacion.toLocaleString('es-CR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            } catch (e) {
                console.error('Error formateando fecha:', e);
            }
        }

        const nombreEmpleado = emp.usuario ? emp.usuario.nombre : 'Sin nombre';
        const primerApellido = emp.usuario ? emp.usuario.primerApellido : 'Sin apellido';
        const popup = `
            <div class="popup-header empleado">
                <i class="fas fa-user-circle"></i>
                Empleado en Campo
            </div>
            <div class="popup-body">
                <div class="popup-row empleado">
                    <i class="fas fa-user"></i>
                    <div>
                        <div class="popup-label">${nombreEmpleado} ${primerApellido}</div>
                    </div>
                </div>
                <div class="popup-row empleado">
                    <i class="fas fa-clock"></i>
                    <div>
                        <span class="popup-label">Última actualización:</span>
                        <br>
                        <span class="popup-value">${fechaFormateada}</span>
                    </div>
                </div>
            </div>
        `;

        marker.bindPopup(popup, {
            maxWidth: 300,
            minWidth: 250,
            autoPan: true,
            keepInView: true,
            closeButton: true
        });

        // Debug: evento cuando se abre el popup
        marker.on('click', function() {
            console.log('Click en marcador de empleado:', emp);
        });

        marker.on('popupopen', function() {
            console.log('Popup abierto para empleado:', emp);
        });
    });

    // Ajustar vista del mapa para mostrar todos los marcadores
    if (puntosVenta.length > 0 || empleados.length > 0) {
        const bounds = L.latLngBounds();
        
        puntosVenta.forEach(pv => {
            if (pv.latitud && pv.longitud) {
                bounds.extend([pv.latitud, pv.longitud]);
            }
        });
        
        empleados.forEach(emp => {
            if (emp.latitud && emp.longitud) {
                bounds.extend([parseFloat(emp.latitud), parseFloat(emp.longitud)]);
            }
        });
        
        if (bounds.isValid()) {
            map.fitBounds(bounds, { padding: [50, 50] });
        }
    }

    console.log('Mapa inicializado correctamente');
</script>
@endsection