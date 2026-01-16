@extends('layouts.app')

@section('title', 'Gestión de Equipos')

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
        border: none;
        cursor: pointer;
    }

    .btn-new:hover {
        background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
        color: white;
    }

    /* Acordeón de Tipos */
    .tipos-accordion {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .tipo-section {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .tipo-section:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
    }

    .tipo-header {
        background: #1b4282;
        padding: 1.25rem 1.5rem;
        cursor: pointer;
        user-select: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .tipo-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
        color: white;
    }

    .collapse-icon {
        font-size: 14px;
        transition: transform 0.3s;
    }

    .tipo-section.collapsed .collapse-icon {
        transform: rotate(-90deg);
    }

    .tipo-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .tipo-nombre {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
    }

    .tipo-count {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
    }

    .tipo-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
    }

    .btn-icon:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    /* Contenido del acordeón */
    .tipo-content {
        max-height: 3000px;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.3s ease;
        padding: 1.5rem;
        background: #fafafa;
    }

    .tipo-section.collapsed .tipo-content {
        max-height: 0;
        padding: 0 1.5rem;
    }

    .equipos-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    /* Cards de Equipos */
    .equipo-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .equipo-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }

    .equipo-header {
        padding: 1.25rem;
        position: relative;
    }

    .equipo-header.estado-activo {
        background: #43a047;
    }

    .equipo-header.estado-inactivo {
        background: #607d8b;
    }

    .equipo-header.estado-mantenimiento {
        background: #fb8c00 ;
    }

    .equipo-header.estado-prestamo {
        background: #8e24aa;
    }

    .equipo-nombre {
        font-weight: 600;
        color: white;
        font-size: 1.1rem;
        margin: 0 0 0.5rem 0;
        padding-right: 60px;
    }

    .equipo-tipo {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.95);
    }

    .estado-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.25);
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .equipo-body {
        padding: 1.25rem;
    }

    .info-row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0.5rem 0;
        color: #666;
        font-size: 14px;
    }

    .info-row i {
        width: 18px;
        color: #1b4282;
        font-size: 13px;
    }

    .punto-venta-info {
        background: #f3e5f5;
        padding: 0.75rem;
        border-radius: 8px;
        margin-top: 0.75rem;
        display: flex;
        align-items: center;
        gap: 8px;
        color: #7b1fa2;
        font-size: 13px;
        font-weight: 500;
    }

    .equipo-footer {
        display: flex;
        gap: 0.5rem;
        padding: 0 1.25rem 1.25rem 1.25rem;
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
        border: none;
        cursor: pointer;
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

    .empty-inside {
        padding: 2.5rem 1rem;
        text-align: center;
        color: #999;
        font-size: 14px;
    }

    .empty-inside i {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        color: #ddd;
    }

    /* Modal */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background: #1b4282 ;
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
        border: none;
    }

    .modal-header h5 {
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 14px;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 10px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: #5299d4;
        box-shadow: 0 0 0 3px rgba(82, 153, 212, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .punto-venta-group {
        display: none;
        margin-top: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #7b1fa2;
    }

    .punto-venta-group.show {
        display: block;
    }

    .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 2px solid #e0e0e0;
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .btn-secondary {
        background: #f5f7fa;
        color: #555;
        padding: 0.7rem 1.5rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #e0e0e0;
        border-color: #d0d0d0;
    }

    .btn-primary {
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
        color: white;
        padding: 0.7rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(82, 153, 212, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
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

        .equipos-list {
            grid-template-columns: 1fr;
        }

        .tipo-header {
            padding: 1rem;
        }

        .tipo-nombre {
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-tools"></i>
        Gestión de equipos
    </h1>

    <div class="header-actions">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input
                type="text"
                id="searchInput"
                class="search-input"
                placeholder="Buscar equipos..."
                autocomplete="off"
            >
            <button class="clear-search" id="clearSearch" onclick="clearSearch()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <button class="btn-new" data-bs-toggle="modal" data-bs-target="#createTipoModal">
            <i class="fas fa-plus-circle"></i>
            Nuevo tipo
        </button>
    </div>
</div>

@if(count($tipos) > 0)
    <div class="tipos-accordion" id="tiposAccordion">
        @foreach($tipos as $tipo)
        <div class="tipo-section" data-tipo="{{ strtolower($tipo->nombre) }}">
            <div class="tipo-header" onclick="toggleSection(this)">
                <div class="tipo-header-left">
                    <i class="fas fa-chevron-down collapse-icon"></i>
                    <div class="tipo-info">
                        <h3 class="tipo-nombre">{{ $tipo->nombre }}</h3>
                        <span class="tipo-count">{{ $tipo->equipos->count() }}</span>
                    </div>
                </div>
                <div class="tipo-actions" onclick="event.stopPropagation()">
                    <button 
                        class="btn-icon" 
                        data-bs-toggle="modal" 
                        data-bs-target="#createEquipoModal"
                        onclick="setTipoEquipo({{ $tipo->id }})"
                        title="Añadir equipo">
                        <i class="fas fa-plus"></i>
                    </button>
                    <form method="POST" action="{{ route('tipo-equipos.destroy', $tipo) }}"
                          style="display:inline"
                          onsubmit="return confirm('¿Eliminar este tipo? Los equipos quedarán sin categoría.')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-icon" type="submit" title="Eliminar tipo">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="tipo-content">
                @if($tipo->equipos->count() > 0)
                    <div class="equipos-list">
                        @foreach($tipo->equipos as $equipo)
                        <div class="equipo-card" 
                             data-nombre="{{ strtolower($equipo->nombre) }}"
                             data-estado="{{ strtolower($equipo->estado) }}">
                            <div class="equipo-header estado-{{ $equipo->estado }}">
                                <span class="estado-badge">{{ ucfirst($equipo->estado) }}</span>
                                <h3 class="equipo-nombre">{{ $equipo->nombre }}</h3>
                                <div class="equipo-tipo">
                                    <i class="fas fa-tag"></i>
                                    <span>{{ $tipo->nombre }}</span>
                                </div>
                            </div>

                            <div class="equipo-body">
                                @if($equipo->descripcion)
                                <div class="info-row">
                                    <i class="fas fa-align-left"></i>
                                    <span>{{ Str::limit($equipo->descripcion, 60) }}</span>
                                </div>
                                @endif

                                <div class="info-row">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $equipo->users->nombre ?? 'Sin asignar' }}</span>
                                </div>

                                <div class="info-row">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ \Carbon\Carbon::parse($equipo->fechaCambio)}}</span>
                                </div>

                                @if($equipo->estado === 'prestamo' && $equipo->puntoVentaId)
                                <div class="punto-venta-info">
                                    <i class="fas fa-store"></i>
                                    <strong>{{ $equipo->puntoVenta->nombre ?? 'N/A' }}</strong>
                                </div>
                                @endif
                            </div>

                            <div class="equipo-footer">
                                <button 
                                    class="btn-edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editEquipoModal{{ $equipo->id }}">
                                    <i class="fas fa-edit"></i>
                                    Editar
                                </button>
                                <form method="POST" action="{{ route('equipos.destroy', $equipo) }}"
                                      style="display:inline; flex: 1;"
                                      onsubmit="return confirm('¿Eliminar este equipo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" style="width: 100%;">
                                        <i class="fas fa-trash-alt"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- MODAL EDITAR EQUIPO -->
                        <div class="modal fade" id="editEquipoModal{{ $equipo->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('equipos.update', $equipo) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>
                                                <i class="fas fa-edit"></i>
                                                Editar Equipo
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label>
                                                <input class="form-control" name="nombre" value="{{ $equipo->nombre }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Descripción</label>
                                                <textarea class="form-control" name="descripcion">{{ $equipo->descripcion }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Estado</label>
                                                <select class="form-select estado-select" name="estado" onchange="togglePuntoVenta(this)">
                                                    <option value="activo" {{ $equipo->estado=='activo'?'selected':'' }}>Activo</option>
                                                    <option value="inactivo" {{ $equipo->estado=='inactivo'?'selected':'' }}>Inactivo</option>
                                                    <option value="mantenimiento" {{ $equipo->estado=='mantenimiento'?'selected':'' }}>Mantenimiento</option>
                                                    <option value="prestamo" {{ $equipo->estado=='prestamo'?'selected':'' }}>Préstamo</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Tipo de Equipo</label>
                                                <select class="form-select" name="tipoEquipoId">
                                                    @foreach($tipos as $tipoEdit)
                                                        <option value="{{ $tipoEdit->id }}" {{ $equipo->tipoEquipoId==$tipoEdit->id?'selected':'' }}>
                                                            {{ $tipoEdit->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input type="hidden" name="usuarioId" value="{{ auth()->user()->id }}">

                                            <div class="punto-venta-group {{ $equipo->estado === 'prestamo' ? 'show' : '' }}">
                                                <label class="form-label">
                                                    <i class="fas fa-store"></i> Punto de Venta
                                                </label>
                                                <select class="form-select" name="puntoVentaId">
                                                    <option value="">Seleccionar...</option>
                                                    @foreach($puntosVenta as $pv)
                                                        <option value="{{ $pv->id }}" {{ $equipo->puntoVentaId==$pv->id?'selected':'' }}>
                                                            {{ $pv->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button class="btn-primary">
                                                <i class="fas fa-save"></i>
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-inside">
                        <i class="fas fa-inbox"></i>
                        <p>No hay equipos en esta categoría</p>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="no-results" id="noResults" style="display:none">
        <i class="fas fa-search"></i>
        <h4>No se encontraron resultados</h4>
        <p>Intenta con otros términos</p>
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-layer-group"></i>
        <h4>No hay tipos de equipos</h4>
        <p>Crea un tipo para comenzar a organizar tus equipos</p>
    </div>
@endif

<!-- MODAL CREAR TIPO -->
<div class="modal fade" id="createTipoModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('tipo-equipos.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        <i class="fas fa-layer-group"></i>
                        Nuevo tipo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nombre del Tipo</label>
                        <input class="form-control" name="nombre" placeholder="Ingrese el nombre del tipo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn-primary">
                        <i class="fas fa-save"></i>
                        Crear
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODAL CREAR EQUIPO -->
<div class="modal fade" id="createEquipoModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('equipos.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        <i class="fas fa-tools"></i>
                        Nuevo equipo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" name="nombre" placeholder="Ingrese el nombre del equipo" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" placeholder="Detalles del equipo..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estado" id="estadoSelectCreate" onchange="togglePuntoVenta(this)">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="mantenimiento">Mantenimiento</option>
                            <option value="prestamo">Préstamo</option>
                        </select>
                    </div>


                    <input type="hidden" name="tipoEquipoId" id="tipoEquipoSelect" value="">

                    <input type="hidden" name="usuarioId" value="{{ auth()->user()->id }}">

                    <div class="punto-venta-group" id="puntoVentaGroupCreate">
                        <label class="form-label">
                            <i class="fas fa-store"></i> Punto de Venta
                        </label>
                        <select class="form-select" name="puntoVentaId">
                            <option value="">Seleccionar...</option>
                            @foreach($puntosVenta as $pv)
                                <option value="{{ $pv->id }}">{{ $pv->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn-primary">
                        <i class="fas fa-save"></i>
                        Crear
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Toggle acordeón
    function toggleSection(header) {
        const section = header.closest('.tipo-section');
        section.classList.toggle('collapsed');
    }

    // Búsqueda
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const tipoSections = document.querySelectorAll('.tipo-section');
    const equipoCards = document.querySelectorAll('.equipo-card');
    const noResults = document.getElementById('noResults');
    const accordion = document.getElementById('tiposAccordion');

    searchInput.addEventListener('input', function() {
        const term = this.value.toLowerCase().trim();
        let visibleCount = 0;

        clearButton.classList.toggle('active', term !== '');

        if (term === '') {
            tipoSections.forEach(section => {
                section.style.display = '';
                section.classList.remove('collapsed');
            });
            equipoCards.forEach(card => card.style.display = '');
            if (noResults) noResults.style.display = 'none';
            if (accordion) accordion.style.display = 'flex';
            return;
        }

        tipoSections.forEach(section => {
            const tipoNombre = section.dataset.tipo;
            const equipos = section.querySelectorAll('.equipo-card');
            let hasVisibleEquipos = false;

            equipos.forEach(card => {
                const nombre = card.dataset.nombre;
                const estado = card.dataset.estado;

                if (nombre.includes(term) || estado.includes(term) || tipoNombre.includes(term)) {
                    card.style.display = '';
                    hasVisibleEquipos = true;
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (hasVisibleEquipos || tipoNombre.includes(term)) {
                section.style.display = '';
                section.classList.remove('collapsed');
            } else {
                section.style.display = 'none';
            }
        });

        if (accordion && noResults) {
            if (visibleCount === 0) {
                accordion.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                accordion.style.display = 'flex';
                noResults.style.display = 'none';
            }
        }
    });

    function clearSearch() {
        searchInput.value = '';
        clearButton.classList.remove('active');
        tipoSections.forEach(section => {
            section.style.display = '';
            section.classList.remove('collapsed');
        });
        equipoCards.forEach(card => card.style.display = '');
        if (accordion) accordion.style.display = 'flex';
        if (noResults) noResults.style.display = 'none';
        searchInput.focus();
    }

    // Establecer tipo al crear equipo
    function setTipoEquipo(tipoId) {
    const select = document.getElementById('tipoEquipoSelect');

    if (select) select.value = tipoId;
    }


    // Toggle punto de venta según estado
    function togglePuntoVenta(selectElement) {
        const puntoVentaGroup = selectElement.closest('.modal-body').querySelector('.punto-venta-group');
        if (puntoVentaGroup) {
            if (selectElement.value === 'prestamo') {
                puntoVentaGroup.classList.add('show');
            } else {
                puntoVentaGroup.classList.remove('show');
            }
        }
    }

    // Inicializar estado de punto de venta en modales de edición
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.estado-select').forEach(select => {
            togglePuntoVenta(select);
        });
    });
</script>
@endsection