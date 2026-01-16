@extends('layouts.app')

@section('title', 'Gestión de Clientes')

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
        background: linear-gradient(135deg,  #1b4282 0%,#5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
        color: white;
    }

    /* Grid de Cards */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .client-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .client-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        background: #1b4282;
        padding: 1.5rem;
        color: white;
    }

    .card-header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.5rem;
        gap: 1rem;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
        flex: 1;
    }

    .btn-notas-header {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.5rem 0.9rem;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        white-space: nowrap;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-notas-header:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        border-color: rgba(255, 255, 255, 0.5);
    }

    .card-country {
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

    .btn-puntos {
        background: #e3f2fd;
        color: #1976d2;
    }

    .btn-puntos:hover {
        background: #1976d2;
        color: white;
    }

    .btn-proyectos {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .btn-proyectos:hover {
        background: #7b1fa2;
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

        .btn-new {
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
        <i class="fas fa-building"></i>
        Gestión de Clientes
    </h1>

    <div class="header-actions">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input
                type="text"
                id="searchInput"
                class="search-input"
                placeholder="Buscar clientes..."
                autocomplete="off"
            >
            <button class="clear-search" id="clearSearch" onclick="clearSearch()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <a href="{{ route('clientes.create') }}" class="btn-new">
            <i class="fas fa-plus-circle"></i>
            Nuevo Cliente
        </a>
    </div>
</div>

@if(count($clientes) > 0)
    <div class="cards-grid" id="cardsGrid">
        @foreach($clientes as $c)
        <div class="client-card" data-nombre="{{ strtolower($c['nombre']) }}" data-pais="{{ strtolower($c['paise']['nombre'] ?? '') }}">
            <div class="card-header">
                <div class="card-header-top">
                    <h3>{{ $c['nombre'] }}</h3>
                    <a href="#" class="btn-notas-header" title="Ver notas">
                        <i class="fas fa-sticky-note"></i>
                        Notas
                    </a>
                </div>
                <div class="card-country">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $c['paise']['nombre'] ?? 'Sin país' }}</span>
                </div>
            </div>

            <div class="card-body">
                <div class="card-actions">
                    <a href="{{ route('clientes.puntos-venta.index', $c['id']) }}" class="card-btn btn-puntos">
                        <i class="fas fa-store"></i>
                        Puntos de servicio
                    </a>
                    <a href="{{ route('clientes.proyectos.index', $c['id']) }}" class="card-btn btn-proyectos">
                        <i class="fas fa-project-diagram"></i>
                        Proyectos
                    </a>
                </div>

                <div class="card-footer">
                    <a href="{{ route('clientes.edit', $c['id']) }}" class="btn-edit">
                        <i class="fas fa-edit"></i>
                        Editar
                    </a>
                    <form method="POST" action="{{ route('clientes.destroy', $c['id']) }}" style="display:inline; flex: 1;" onsubmit="return confirm('¿Está seguro de eliminar este cliente?')">
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
        <i class="fas fa-building"></i>
        <h4>No hay clientes registrados</h4>
        <p>Agrega un nuevo cliente para comenzar</p>
    </div>
@endif
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const cards = document.querySelectorAll('.client-card');
    const noResults = document.getElementById('noResults');
    const cardsGrid = document.getElementById('cardsGrid');

    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase().trim();
        let visible = 0;

        clearButton.classList.toggle('active', term !== '');

        cards.forEach(card => {
            const nombre = card.dataset.nombre;
            const pais = card.dataset.pais;

            if (nombre.includes(term) || pais.includes(term)) {
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