@extends('layouts.app')

@section('title', 'Tareas de ' . $puntoVenta->nombre)

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

    .btn-calendar {
        background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(67, 160, 71, 0.3);
        white-space: nowrap;
    }

    .btn-calendar:hover {
        background: linear-gradient(135deg, #43a047 0%, #66bb6a 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 160, 71, 0.4);
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

    /* Grid de Cards Compacto */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.25rem;
        margin-top: 2rem;
    }

    .tarea-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        border-left: 4px solid #1b4282;
    }

    .tarea-card.inactiva {
        opacity: 0.65;
        border-left-color: #999;
    }

    .tarea-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #1b4282 0%, #2c5aa0 100%);
        padding: 1rem;
        color: white;
    }

    .card-title-row {
        display: flex;
        justify-content: space-between;
        align-items: start;
        gap: 8px;
        margin-bottom: 0.4rem;
    }

    .card-title {
        font-size: 1.05rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.3;
    }

    .status-badge {
        font-size: 0.65rem;
        padding: 3px 8px;
        border-radius: 10px;
        font-weight: 600;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .status-badge.activa {
        background: rgba(76, 175, 80, 0.95);
    }

    .status-badge.inactiva {
        background: rgba(158, 158, 158, 0.95);
    }

    .card-descripcion {
        font-size: 0.8rem;
        opacity: 0.9;
        line-height: 1.3;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-body {
        padding: 1rem;
    }

    .info-compact {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .info-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .info-badge i {
        font-size: 0.7rem;
    }

    .badge-frecuencia {
        background: #e3f2fd;
        color: #1976d2;
    }

    .badge-fecha {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .badge-proyecto {
        background: #e8f5e9;
        color: #388e3c;
    }

    .dias-row {
        display: flex;
        gap: 4px;
        margin-bottom: 0.75rem;
    }

    .dia-badge {
        background: #1b4282;
        color: white;
        padding: 3px 7px;
        border-radius: 5px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .usuarios-compact {
        padding-top: 0.75rem;
        border-top: 1px solid #e9ecef;
    }

    .usuarios-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .usuarios-label i {
        font-size: 0.65rem;
    }

    .usuarios-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .usuario-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #f0f4f8;
        color: #1b4282;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
        border: 1px solid #d0dae5;
    }

    .usuario-chip i {
        font-size: 0.65rem;
    }

    .no-usuarios {
        color: #999;
        font-style: italic;
        font-size: 0.75rem;
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .btn-edit {
        flex: 1;
        background: #e3f2fd;
        color: #1976d2;
        padding: 0.5rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: all 0.3s ease;
        border: 1px solid #bbdefb;
    }

    .btn-edit:hover {
        background: #1976d2;
        color: white;
        border-color: #1976d2;
    }

    .btn-delete {
        flex: 1;
        background: #ffebee;
        color: #c62828;
        padding: 0.5rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid #ffcdd2;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: #c62828;
        color: white;
        border-color: #c62828;
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
        .btn-calendar,
        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-tasks"></i>
        Tareas de {{ $puntoVenta->nombre }}
    </h1>

    <div class="header-actions">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input
                type="text"
                id="searchInput"
                class="search-input"
                placeholder="Buscar tareas..."
                autocomplete="off"
            >
            <button class="clear-search" id="clearSearch" onclick="clearSearch()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <a href="{{ route('puntos-venta.tareas.create', $puntoVenta) }}" class="btn-new">
            <i class="fas fa-plus-circle"></i>
            Nueva Tarea
        </a>

        <a href="{{ route('puntos-venta.calendario', $puntoVenta) }}" class="btn-calendar">
            <i class="fas fa-calendar-alt"></i>
            Calendario
        </a>

        <a href="{{ route('clientes.puntos-venta.index', $puntoVenta->clienteId) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </div>
</div>

@if($puntoVenta->tareas->count())
    <div class="cards-grid" id="cardsGrid">
        @foreach($puntoVenta->tareas as $tarea)
        <div class="tarea-card {{ $tarea->activa ? '' : 'inactiva' }}" 
             data-search="{{ strtolower($tarea->nombre . ' ' . ($tarea->descripcion ?? '')) }}">
            
            <div class="card-header">
                <div class="card-title-row">
                    <h3 class="card-title">{{ $tarea->nombre }}</h3>
                    <span class="status-badge {{ $tarea->activa ? 'activa' : 'inactiva' }}">
                        {{ $tarea->activa ? 'Activa' : 'Inactiva' }}
                    </span>
                </div>
                @if($tarea->descripcion)
                <p class="card-descripcion">{{ $tarea->descripcion }}</p>
                @endif
            </div>

            <div class="card-body">
                <!-- Info compacta con badges -->
                <div class="info-compact">
                    <span class="info-badge badge-frecuencia">
                        <i class="fas fa-redo"></i>
                        {{ ucfirst($tarea->frecuencia) }}
                    </span>
                    
                    <span class="info-badge badge-fecha">
                        <i class="fas fa-calendar"></i>
                        {{ $tarea->fecha_inicio ? $tarea->fecha_inicio->format('d/m/Y') : 'Sin fecha' }}
                    </span>
                    @if ($tarea->frecuencia != 'unica')
                        <span class="info-badge badge-fecha">
                        <i class="fas fa-calendar"></i>
                        {{ $tarea->fecha_fin ? $tarea->fecha_fin->format('d/m/Y') : 'Sin fecha' }}
                    </span>
                    @endif
                    

                    @if($tarea->proyecto)
                    <span class="info-badge badge-proyecto">
                        <i class="fas fa-project-diagram"></i>
                        {{ $tarea->proyecto->nombre }}
                    </span>
                    @endif
                </div>

                <!-- Días de la semana -->
                @if($tarea->dias_semana && count($tarea->dias_semana) > 0)
                <div class="dias-row">
                    @php
                        $diasMap = [
                            '1' => 'L', '2' => 'K', '3' => 'M',
                            '4' => 'J', '5' => 'V', '6' => 'S', '7' => 'D'
                        ];
                    @endphp
                    @foreach($tarea->dias_semana as $dia)
                        <span class="dia-badge">{{ $diasMap[$dia] ?? $dia }}</span>
                    @endforeach
                </div>
                @endif

                <!-- Usuarios asignados -->
                <div class="usuarios-compact">
                    <div class="usuarios-label">
                        <i class="fas fa-users"></i>
                        Asignado a
                    </div>
                    
                    @if($tarea->usuarios->isNotEmpty())
                        <div class="usuarios-chips">
                            @foreach($tarea->usuarios as $usuario)
                            <span class="usuario-chip">
                                <i class="fas fa-user"></i>
                                {{ $usuario->nombre }} {{ $usuario->primerApellido }}
                            </span>
                            @endforeach
                        </div>
                    @else
                        <div class="no-usuarios">Sin usuarios asignados</div>
                    @endif
                </div>
            </div>

            <div class="card-actions">
                <a href="{{ route('puntos-venta.tareas.edit', [$puntoVenta, $tarea]) }}" class="btn-edit">
                    <i class="fas fa-edit"></i>
                    Editar
                </a>
                <form method="POST" action="{{ route('puntos-venta.tareas.destroy', [$puntoVenta, $tarea]) }}" style="display:inline; flex: 1;" onsubmit="return confirm('¿Está seguro de eliminar esta tarea?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" style="width: 100%;">
                        <i class="fas fa-trash-alt"></i>
                        Eliminar
                    </button>
                </form>
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
        <i class="fas fa-tasks"></i>
        <h4>No hay tareas registradas</h4>
        <p>Agrega una nueva tarea para comenzar</p>
    </div>
@endif
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const cards = document.querySelectorAll('.tarea-card');
    const noResults = document.getElementById('noResults');
    const cardsGrid = document.getElementById('cardsGrid');

    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase().trim();
        let visible = 0;

        clearButton.classList.toggle('active', term !== '');

        cards.forEach(card => {
            const searchText = card.dataset.search;

            if (searchText.includes(term)) {
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