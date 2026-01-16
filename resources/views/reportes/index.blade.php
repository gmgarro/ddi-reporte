@extends('layouts.app')

@section('title', 'Reportes de ' . $puntoVenta->nombre)

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

    .header-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
        justify-content: flex-end;
        flex-wrap: wrap;
    }

    /* Filtros */
    .filters-section {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    }

    .filters-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .filters-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filters-title i {
        color: #1b4282;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .filter-label {
        font-size: 14px;
        font-weight: 600;
        color: #555;
    }

    .filter-input {
        padding: 10px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }

    .filter-input:focus {
        outline: none;
        border-color: #5299d4;
        box-shadow: 0 0 0 3px rgba(82, 153, 212, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 10px;
    }

    .btn-filter {
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(82, 153, 212, 0.3);
    }

    .btn-filter:hover {
        background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
    }

    .btn-clear-filter {
        background: #f5f5f5;
        color: #666;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-clear-filter:hover {
        background: #e0e0e0;
    }

    .btn-excel {
        background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
    }

    .btn-excel:hover {
        background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
    }

    .btn-excel:disabled {
        background: #ccc;
        cursor: not-allowed;
        box-shadow: none;
    }

    .btn-excel:disabled:hover {
        transform: none;
    }

    /* Barra de búsqueda minimalista */
    .search-wrapper {
        position: relative;
        min-width: 300px;
        max-width: 400px;
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 15px;
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        padding: 10px 40px 10px 40px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }

    .search-input:focus {
        outline: none;
        border-color: #5299d4;
        box-shadow: 0 0 0 3px rgba(82, 153, 212, 0.1);
    }

    .clear-search {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #999;
        font-size: 16px;
        cursor: pointer;
        padding: 5px;
        display: none;
        transition: color 0.3s;
    }

    .clear-search:hover {
        color: #c62828;
    }

    .clear-search.active {
        display: block;
    }

    .btn-new {
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(82, 153, 212, 0.3);
        white-space: nowrap;
    }

    .btn-new:hover {
        background: linear-gradient(135deg,  #1b4282 0%, #5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
        color: white;
    }

    /* Tabla */
    .table-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        padding: 0;
    }

    .custom-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
    }

    .custom-table thead {
        background: #1b4282;
        border-top-left-radius: 15px;
    }

    .custom-table thead th {
        color: white;
        font-weight: 600;
        padding: 18px 20px;
        text-align: left;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    .custom-table tbody tr {
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .custom-table tbody tr:last-child {
        border-bottom: none;
    }

    .custom-table tbody td {
        padding: 18px 20px;
        color: #555;
        font-size: 15px;
        vertical-align: middle;
    }

    .user-list {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .user-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #555;
    }

    .user-item i {
        color: #5299d4;
        font-size: 13px;
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-back {
        background: linear-gradient(135deg, #78909c 0%, #455a64 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(69, 90, 100, 0.3);
        white-space: nowrap;
    }

    .btn-back:hover {
        background: linear-gradient(135deg, #455a64 0%, #78909c 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(69, 90, 100, 0.4);
        color: white;
    }

    .btn-view {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .btn-view:hover {
        background: #2e7d32;
        color: white;
        transform: translateY(-2px);
    }

    .actions-cell {
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #999;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #ddd;
    }

    .empty-state h4 {
        margin-bottom: 0.5rem;
        color: #666;
    }

    .no-results {
        text-align: center;
        padding: 3rem 2rem;
        color: #999;
    }

    .no-results i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #ddd;
    }

    .active-filter-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #e3f2fd;
        color: #1976d2;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .header-actions {
            flex-direction: column;
            width: 100%;
        }

        .search-wrapper {
            min-width: 100%;
            max-width: 100%;
        }

        .btn-new,
        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .filters-grid {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            flex-direction: column;
        }

        .btn-filter,
        .btn-clear-filter,
        .btn-excel {
            width: 100%;
            justify-content: center;
        }

        .custom-table {
            font-size: 14px;
        }

        .custom-table thead th,
        .custom-table tbody td {
            padding: 12px 10px;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 13px;
        }
    }

    @media (max-width: 576px) {
        .table-container {
            border-radius: 10px;
        }

        .custom-table thead {
            display: none;
        }

        .custom-table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
        }

        .custom-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .custom-table tbody td:last-child {
            border-bottom: none;
            flex-direction: column;
            align-items: stretch;
        }

        .custom-table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #333;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-file-alt"></i>
        Reportes de {{ $puntoVenta->nombre }}
    </h1>

    <div class="header-actions">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input 
                type="text" 
                id="searchInput" 
                class="search-input" 
                placeholder="Buscar reporte..."
                autocomplete="off"
            >
            <button class="clear-search" id="clearSearch" onclick="clearSearch()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <a href="{{ route('puntos-venta.reportes.create', $puntoVenta) }}" class="btn-new">
            <i class="fas fa-plus-circle"></i>
            Crear Reporte Manual
        </a>

        <a href="{{ route('clientes.puntos-venta.index', $puntoVenta->clienteId) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </div>
</div>

<!-- Sección de Filtros -->
<div class="filters-section">
    <div class="filters-header">
        <div class="filters-title">
            <i class="fas fa-filter"></i>
            Filtrar por Rango de Fechas
        </div>
        <div id="activeFilterBadge" style="display: none;">
            <span class="active-filter-badge">
                <i class="fas fa-check-circle"></i>
                Filtro Activo
            </span>
        </div>
    </div>
    
    <form id="filterForm">
        <div class="filters-grid">
            <div class="filter-group">
                <label class="filter-label" for="fechaInicio">Fecha Inicio</label>
                <input 
                    type="date" 
                    id="fechaInicio" 
                    name="fechaInicio" 
                    class="filter-input"
                >
            </div>

            <div class="filter-group">
                <label class="filter-label" for="fechaFin">Fecha Fin</label>
                <input 
                    type="date" 
                    id="fechaFin" 
                    name="fechaFin" 
                    class="filter-input"
                >
            </div>

            <div class="filter-group">
                <div class="filter-actions">
                    <button type="button" class="btn-filter" onclick="aplicarFiltro()">
                        <i class="fas fa-search"></i>
                        Filtrar
                    </button>
                    <button type="button" class="btn-clear-filter" onclick="limpiarFiltro()">
                        <i class="fas fa-eraser"></i>
                        Limpiar
                    </button>
                </div>
            </div>

            <div class="filter-group">
                <button type="button" class="btn-excel" id="btnExcel" onclick="exportarExcel()" disabled>
                    <i class="fas fa-file-excel"></i>
                    Exportar a Excel
                </button>
            </div>
        </div>
    </form>
</div>

<div class="table-container">
    @if($puntoVenta->reportes->count() > 0)
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Técnicos Asignados</th>
                    <th style="text-align:center;">Acciones</th>
                </tr>
            </thead>
            <tbody id="reportesTableBody">
                @foreach($puntoVenta->reportes as $reporte)
                <tr class="reporte-row" data-fecha="{{ $reporte->fecha->format('Y-m-d') }}">
                    <td data-label="Fecha">
                        <strong>{{ $reporte->fecha->format('d/m/Y') }}</strong>
                        @if($reporte->horaInicial && $reporte->horaFinal)
                            <br>
                            <small style="color: #888;">
                                {{ $reporte->horaInicial->format('H:i') }} - {{ $reporte->horaFinal->format('H:i') }}
                            </small>
                        @endif
                    </td>
                    <td data-label="Técnicos Asignados">
                        <div class="user-list">
                            @forelse($reporte->usuarios as $usuario)
                                <span class="user-item">
                                    <i class="fas fa-user-circle"></i>
                                    {{ $usuario->nombre }}
                                </span>
                            @empty
                                <span style="color: #999; font-style: italic;">Sin técnicos asignados</span>
                            @endforelse
                        </div>
                    </td>
                    <td data-label="Acciones" class="actions-cell" style="text-align:center;">
                        <a href="{{ route('reportes.show', $reporte->id) }}" class="btn-action btn-view">
                            <i class="fas fa-eye"></i>
                            Ver Reporte
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="no-results" id="noResults" style="display:none;">
            <i class="fas fa-search"></i>
            <h4>No se encontraron resultados</h4>
            <p>Intente con otros términos de búsqueda o ajuste el filtro de fechas</p>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-file-invoice"></i>
            <h4>No hay reportes registrados</h4>
            <p>Cree el primer reporte para este punto de servicio</p>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const rows = document.querySelectorAll('.reporte-row');
    const tableBody = document.getElementById('reportesTableBody');
    const noResults = document.getElementById('noResults');
    const btnExcel = document.getElementById('btnExcel');
    const activeFilterBadge = document.getElementById('activeFilterBadge');

    let filteredRows = [];
    let isFilterActive = false;

    // Búsqueda general
    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase().trim();
        let visible = 0;

        clearButton.classList.toggle('active', term !== '');

        const rowsToSearch = isFilterActive ? filteredRows : rows;

        rowsToSearch.forEach(row => {
            const fecha = row.querySelector('[data-label="Fecha"]').textContent.toLowerCase();
            const tecnicos = row.querySelector('[data-label="Técnicos Asignados"]').textContent.toLowerCase();

            if (fecha.includes(term) || tecnicos.includes(term)) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        if (visible === 0 && term) {
            tableBody.style.display = 'none';
            noResults.style.display = 'block';
        } else {
            tableBody.style.display = '';
            noResults.style.display = 'none';
        }
    });

    function clearSearch() {
        searchInput.value = '';
        clearButton.classList.remove('active');
        
        if (isFilterActive) {
            aplicarFiltro();
        } else {
            rows.forEach(row => row.style.display = '');
        }
        
        tableBody.style.display = '';
        noResults.style.display = 'none';
        searchInput.focus();
    }

    // Filtro por fechas
    function aplicarFiltro() {
        const fechaInicio = document.getElementById('fechaInicio').value;
        const fechaFin = document.getElementById('fechaFin').value;

        if (!fechaInicio && !fechaFin) {
            alert('Por favor seleccione al menos una fecha');
            return;
        }

        searchInput.value = '';
        clearButton.classList.remove('active');

        filteredRows = [];
        let visible = 0;

        rows.forEach(row => {
            const fechaReporte = row.getAttribute('data-fecha');
            let mostrar = true;

            if (fechaInicio && fechaReporte < fechaInicio) {
                mostrar = false;
            }

            if (fechaFin && fechaReporte > fechaFin) {
                mostrar = false;
            }

            if (mostrar) {
                row.style.display = '';
                filteredRows.push(row);
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        isFilterActive = true;
        activeFilterBadge.style.display = 'block';
        btnExcel.disabled = visible === 0;

        if (visible === 0) {
            tableBody.style.display = 'none';
            noResults.style.display = 'block';
        } else {
            tableBody.style.display = '';
            noResults.style.display = 'none';
        }
    }

    function limpiarFiltro() {
        document.getElementById('fechaInicio').value = '';
        document.getElementById('fechaFin').value = '';
        searchInput.value = '';
        clearButton.classList.remove('active');
        
        rows.forEach(row => row.style.display = '');
        
        isFilterActive = false;
        filteredRows = [];
        activeFilterBadge.style.display = 'none';
        btnExcel.disabled = true;
        tableBody.style.display = '';
        noResults.style.display = 'none';
    }

    function exportarExcel() {
        const fechaInicio = document.getElementById('fechaInicio').value;
        const fechaFin = document.getElementById('fechaFin').value;

        if (!isFilterActive || filteredRows.length === 0) {
            alert('Debe aplicar un filtro de fechas antes de exportar');
            return;
        }

        // Construir URL con parámetros
        const params = new URLSearchParams({
            fechaInicio: fechaInicio || '',
            fechaFin: fechaFin || ''
        });

        window.location.href =
        "{{ route('puntos-venta.excel', $puntoVenta->id) }}?" + params.toString();
    }
</script>
@endsection