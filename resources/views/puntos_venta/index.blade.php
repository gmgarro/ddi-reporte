@extends('layouts.app')

@section('title', 'Puntos de Venta')

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
    }

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
        padding: 10px 40px;
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
        background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
        color: white;
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

    /* Grid de Cards */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .punto-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .punto-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: #1b4282;
        padding: 1.5rem;
        color: white;
    }

    .card-header h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1.3rem;
        font-weight: 600;
    }

    .card-provincia {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        opacity: 0.95;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .card-btn {
        padding: 0.7rem 1rem;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-tareas {
        background: #fff3e0;
        color: #e65100;
    }

    .btn-tareas:hover {
        background: #e65100;
        color: white;
    }

    .btn-encargados {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .btn-encargados:hover {
        background: #7b1fa2;
        color: white;
    }

    .btn-reportes {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .btn-reportes:hover {
        background: #2e7d32;
        color: white;
    }

    .btn-mapa {
        background: #e1f5fe;
        color: #0277bd;
    }

    .btn-mapa:hover {
        background: #0277bd;
        color: white;
    }

    .card-footer {
        display: flex;
        gap: 0.5rem;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
    }

    .btn-edit {
        flex: 1;
        background: #e3f2fd;
        color: #1976d2;
        padding: 0.7rem;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background: #1976d2;
        color: white;
    }

    .btn-delete {
        flex: 1;
        background: #ffebee;
        color: #c62828;
        padding: 0.7rem;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: #c62828;
        color: white;
    }

    .empty-state,
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        color: #999;
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    }

    .empty-state i,
    .no-results i {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #ddd;
    }

    .empty-state h4,
    .no-results h4 {
        margin-bottom: 0.5rem;
        color: #666;
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

        .cards-grid {
            grid-template-columns: 1fr;
        }

        .card-actions {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .card-header h3 {
            font-size: 1.1rem;
        }

        .card-body {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-store"></i>
        Puntos de servicio de {{ $cliente->nombre }}
    </h1>

    <div class="header-actions">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input
                type="text"
                id="searchInput"
                class="search-input"
                placeholder="Buscar puntos de servicio..."
                autocomplete="off"
            >
            <button class="clear-search" id="clearSearch" onclick="clearSearch()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <a href="{{ route('clientes.puntos-venta.create', $cliente) }}" class="btn-new">
            <i class="fas fa-plus-circle"></i>
            Nuevo punto de servicio
        </a>

        <a href="{{ route('clientes.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </div>
</div>

@if($cliente->puntosVenta->count())
    <div class="cards-grid" id="cardsGrid">
        @foreach($cliente->puntosVenta as $pv)
        <div class="punto-card" data-nombre="{{ strtolower($pv->nombre) }}" data-provincia="{{ strtolower($pv->provincia->nombre) }}">
            <div class="card-header">
                <h3>{{ $pv->nombre }}</h3>
                <div class="card-provincia">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $pv->provincia->nombre }}</span>
                </div>
            </div>

            <div class="card-body">
                <div class="card-actions">
                    <a href="{{ route('puntos-venta.tareas.index', $pv) }}" class="card-btn btn-tareas">
                        <i class="fas fa-tasks"></i>
                        Tareas
                    </a>
                    <a href="{{ route('puntos-venta.encargados.index', $pv) }}" class="card-btn btn-encargados">
                        <i class="fas fa-user-tie"></i>
                        Encargados
                    </a>
                    <a href="{{ route('puntos-venta.reportes.index', $pv) }}" class="card-btn btn-reportes">
                        <i class="fas fa-chart-bar"></i>
                        Reportes
                    </a>
                    <a href="https://www.google.com/maps?q={{ $pv->latitud }},{{ $pv->longitud }}" 
                       target="_blank" 
                       class="card-btn btn-mapa">
                        <i class="fas fa-map-marked-alt"></i>
                        Ver en mapa
                    </a>
                </div>

                <div class="card-footer">
                    <a href="{{ route('clientes.puntos-venta.edit', [$cliente, $pv]) }}" class="btn-edit">
                        <i class="fas fa-edit"></i>
                        Editar
                    </a>
                    <form method="POST" action="{{ route('clientes.puntos-venta.destroy', [$cliente, $pv]) }}" style="display:inline; flex: 1;" onsubmit="return confirm('¿Está seguro de eliminar este punto de venta?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" style="width: 100%;">
                            <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="no-results" id="noResults" style="display:none">
        <i class="fas fa-search"></i>
        <h4>No se encontraron resultados</h4>
        <p>Intenta con otros términos de búsqueda</p>
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-store"></i>
        <h4>No hay puntos de servicio registrados</h4>
        <p>Agrega un nuevo punto de servicio para comenzar</p>
    </div>
@endif
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const cards = document.querySelectorAll('.punto-card');
    const noResults = document.getElementById('noResults');
    const cardsGrid = document.getElementById('cardsGrid');

    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase().trim();
        let visible = 0;

        clearButton.classList.toggle('active', term !== '');

        cards.forEach(card => {
            const nombre = card.dataset.nombre;
            const provincia = card.dataset.provincia;

            if (nombre.includes(term) || provincia.includes(term)) {
                card.style.display = '';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        if (visible === 0 && term) {
            cardsGrid.style.display = 'none';
            noResults.style.display = 'block';
        } else {
            cardsGrid.style.display = 'grid';
            noResults.style.display = 'none';
        }
    });

    function clearSearch() {
        searchInput.value = '';
        clearButton.classList.remove('active');
        cards.forEach(card => card.style.display = '');
        cardsGrid.style.display = 'grid';
        noResults.style.display = 'none';
        searchInput.focus();
    }
</script>
@endsection