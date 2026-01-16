@extends('layouts.app')

@section('title', 'Crear punto de venta')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.css" />
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

    .breadcrumb {
        display: flex;
        gap: 8px;
        align-items: center;
        color: #666;
        font-size: 14px;
        margin-bottom: 1rem;
    }

    .breadcrumb a {
        color: #5299d4;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        max-width: 1000px;
        margin: 0 auto;
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
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 16px;
        pointer-events: none;
        z-index: 10;
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

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 45px;
    }

    .map-container {
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    #map {
        height: 450px;
        width: 100%;
        position: relative;
    }

    .map-search-container {
        padding: 15px;
        background: #f8f9fa;
        border-bottom: 2px solid #e0e0e0;
        position: relative;
    }

    .search-box {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        background: white;
    }

    .search-box:focus {
        outline: none;
        border-color: #5299d4;
        box-shadow: 0 0 0 3px rgba(82, 153, 212, 0.1);
    }

    .search-results {
        position: absolute;
        top: 100%;
        left: 15px;
        right: 15px;
        background: white;
        border: 2px solid #5299d4;
        border-top: none;
        border-radius: 0 0 10px 10px;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: none;
    }

    .search-results.active {
        display: block;
    }

    .search-result-item {
        padding: 12px 15px;
        cursor: pointer;
        border-bottom: 1px solid #e0e0e0;
        transition: background 0.2s;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-item:hover {
        background: #f0f7ff;
    }

    .search-result-item i {
        color: #5299d4;
        margin-right: 8px;
    }

    .search-loading {
        padding: 12px 15px;
        text-align: center;
        color: #666;
    }

    .search-no-results {
        padding: 12px 15px;
        text-align: center;
        color: #999;
    }

    .coordinates-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .coordinate-input {
        padding-left: 15px;
    }

    .info-box {
        background: #e3f2fd;
        border-left: 4px solid #5299d4;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 14px;
        color: #555;
    }

    .info-box i {
        color: #5299d4;
        margin-right: 8px;
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

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        border: none;
    }

    .alert-danger {
        background: #ffebee;
        color: #c62828;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .alert-danger li {
        margin: 0.25rem 0;
    }

    /* Estilos personalizados para Leaflet */
    .leaflet-popup-content-wrapper {
        border-radius: 10px;
        box-shadow: 0 3px 14px rgba(0,0,0,0.2);
    }

    .leaflet-popup-content {
        margin: 15px;
        font-size: 14px;
    }

    /* Botón de geolocalización personalizado */
    .locate-button {
        position: absolute;
        top: 80px;
        right: 10px;
        z-index: 1000;
        background: white;
        border: 2px solid rgba(0,0,0,0.2);
        border-radius: 8px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .locate-button:hover {
        background: #f0f7ff;
        border-color: #5299d4;
    }

    .locate-button i {
        color: #555;
        font-size: 18px;
    }

    .locate-button:hover i {
        color: #5299d4;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .coordinates-grid {
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

        #map {
            height: 350px;
        }
    }

    @media (max-width: 576px) {
        .form-container {
            padding: 1rem;
        }

        #map {
            height: 300px;
        }
    }
</style>
@endsection

@section('content')

<div class="form-container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="fas fa-exclamation-circle"></i> Errores en el formulario:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('clientes.puntos-venta.store', $cliente) }}">
        @csrf

        <!-- Información del Punto de Venta -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-info-circle"></i>
                Información del punto de servicio
            </h3>

            <div class="form-group">
                <label class="form-label required">Nombre del punto de servicio</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-store"></i></span>
                    <input 
                        type="text" 
                        name="nombre" 
                        class="form-control"
                        value="{{ old('nombre') }}"
                        placeholder="Ej: Tienda Centro, Sucursal Norte"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label class="form-label required">Provincia</label>
                <div class="input-wrapper">
                    <span class="input-icon"><i class="fas fa-map-marked-alt"></i></span>
                    <select name="provinciaId" class="form-control" required>
                        <option value="">Seleccione una provincia</option>
                        @foreach($provincias as $prov)
                            <option value="{{ $prov->id }}" {{ old('provinciaId') == $prov->id ? 'selected' : '' }}>
                                {{ $prov->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Ubicación en Mapa -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-map-marker-alt"></i>
                Ubicación en el mapa
            </h3>

            <div class="info-box">
                <i class="fas fa-lightbulb"></i>
                <strong>Instrucciones:</strong> Busca una dirección, haz clic en el mapa para marcar la ubicación, o usa el botón de geolocalización para encontrar tu ubicación actual.
            </div>

            <div class="map-container">
                <div class="map-search-container">
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="fas fa-search"></i></span>
                        <input 
                            id="searchBox" 
                            class="search-box" 
                            type="text" 
                            placeholder="Buscar dirección, ciudad o lugar..."
                            autocomplete="off"
                        >
                    </div>
                    <div id="searchResults" class="search-results"></div>
                </div>
                <div id="map">
                    <div class="locate-button" id="locateBtn" title="Usar mi ubicación">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                </div>
            </div>

            <div class="coordinates-grid">
                <div class="form-group">
                    <label class="form-label required">Latitud</label>
                    <input 
                        type="text" 
                        name="latitud" 
                        id="latitud" 
                        class="form-control coordinate-input"
                        value="{{ old('latitud') }}"
                        placeholder="Ej: 9.9333"
                        readonly
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label required">Longitud</label>
                    <input 
                        type="text" 
                        name="longitud" 
                        id="longitud" 
                        class="form-control coordinate-input"
                        value="{{ old('longitud') }}"
                        placeholder="Ej: -84.0833"
                        readonly
                        required
                    >
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Guardar punto de servicio
            </button>
            <a href="{{ route('clientes.puntos-venta.index', $cliente) }}" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                Cancelar
            </a>
        </div>
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Coordenadas iniciales DDI escazu
    let lat = {{ old('latitud', '9.9531088') }};
    let lng = {{ old('longitud', '-84.1607629') }};

    const paisCodigo = '{{ $paisCodigo }}';

    // Inicializar el mapa con tema más bonito
    const map = L.map('map').setView([lat, lng], 13);

    // Usar tiles de OpenStreetMap con mejor diseño
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // Icono personalizado para el marcador
    const customIcon = L.divIcon({
        className: 'custom-marker',
        html: '<div style="background: #1b4282; width: 30px; height: 30px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 3px solid white; box-shadow: 0 3px 10px rgba(0,0,0,0.3);"><div style="transform: rotate(45deg); margin-top: 5px; margin-left: 8px; color: white; font-size: 14px;"><i class="fas fa-store"></i></div></div>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
    });

    // Crear marcador arrastrable
    let marker = L.marker([lat, lng], { 
        draggable: true,
        icon: customIcon
    }).addTo(map);

    // Popup inicial
    marker.bindPopup('<strong>📍 Ubicación seleccionada</strong><br>Arrastra el marcador para ajustar').openPopup();

    // Función para actualizar coordenadas
    function updateCoordinates(latitude, longitude) {
        document.getElementById('latitud').value = latitude.toFixed(7);
        document.getElementById('longitud').value = longitude.toFixed(7);
        marker.setLatLng([latitude, longitude]);
        map.setView([latitude, longitude], map.getZoom());
        marker.bindPopup('<strong>📍 Ubicación seleccionada</strong><br>Lat: ' + latitude.toFixed(6) + '<br>Lng: ' + longitude.toFixed(6)).openPopup();
    }

    // Evento al arrastrar el marcador
    marker.on('dragend', function(e) {
        const pos = marker.getLatLng();
        updateCoordinates(pos.lat, pos.lng);
    });

    // Evento al hacer clic en el mapa
    map.on('click', function(e) {
        updateCoordinates(e.latlng.lat, e.latlng.lng);
    });

    // Búsqueda con Nominatim (OpenStreetMap)
    const searchBox = document.getElementById('searchBox');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;

    searchBox.addEventListener('input', function(e) {
        const query = e.target.value.trim();
        
        if (query.length < 3) {
            searchResults.classList.remove('active');
            return;
        }

        clearTimeout(searchTimeout);
        
        searchTimeout = setTimeout(() => {
            searchResults.innerHTML = '<div class="search-loading"><i class="fas fa-spinner fa-spin"></i> Buscando...</div>';
            searchResults.classList.add('active');

            // Buscar con Nominatim
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=${paisCodigo.toLowerCase()}&limit=5`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        searchResults.innerHTML = '<div class="search-no-results"><i class="fas fa-search"></i> No se encontraron resultados</div>';
                        return;
                    }

                    let html = '';
                    data.forEach(place => {
                        html += `
                            <div class="search-result-item" onclick="selectPlace(${place.lat}, ${place.lon}, '${place.display_name.replace(/'/g, "\\'")}')">
                                <i class="fas fa-map-marker-alt"></i>
                                ${place.display_name}
                            </div>
                        `;
                    });
                    searchResults.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error en búsqueda:', error);
                    searchResults.innerHTML = '<div class="search-no-results"><i class="fas fa-exclamation-triangle"></i> Error en la búsqueda</div>';
                });
        }, 500);
    });

    // Función para seleccionar un lugar
    function selectPlace(lat, lon, name) {
        updateCoordinates(lat, lon);
        map.setZoom(16);
        searchResults.classList.remove('active');
        searchBox.value = name;
    }

    // Cerrar resultados al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!searchBox.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.remove('active');
        }
    });

    // Botón de geolocalización
    document.getElementById('locateBtn').addEventListener('click', function() {
        if (navigator.geolocation) {
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    updateCoordinates(position.coords.latitude, position.coords.longitude);
                    map.setZoom(16);
                    this.innerHTML = '<i class="fas fa-crosshairs"></i>';
                },
                (error) => {
                    alert('No se pudo obtener tu ubicación. Por favor, permite el acceso a la ubicación en tu navegador.');
                    this.innerHTML = '<i class="fas fa-crosshairs"></i>';
                }
            );
        } else {
            alert('Tu navegador no soporta geolocalización.');
        }
    });

    // Inicializar coordenadas
    updateCoordinates(lat, lng);
</script>
@endsection