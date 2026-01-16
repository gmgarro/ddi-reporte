@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

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

    .role-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .role-admin {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .role-user {
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
        color: white;
    }

    .role-editor {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
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

    .btn-edit {
        background: #e3f2fd;
        color: #1976d2;
        margin-right: 8px;
    }

    .btn-edit:hover {
        background: #1976d2;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #ffebee;
        color: #c62828;
    }

    .btn-delete:hover {
        background: #c62828;
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

        .actions-cell {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-edit {
            margin-right: 0;
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

        .actions-cell {
            flex-direction: column;
            gap: 8px;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .btn-edit {
            margin-right: 0;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-users"></i>
        Gestión de Usuarios
    </h1>
    <div class="header-actions">
        <div class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input 
                type="text" 
                id="searchInput" 
                class="search-input" 
                placeholder="Buscar usuarios..."
                autocomplete="off"
            >
            <button class="clear-search" id="clearSearch" onclick="clearSearch()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <a href="{{ route('users.create') }}" class="btn-new">
            <i class="fas fa-plus-circle"></i>
            Nuevo Usuario
        </a>
    </div>
</div>

<div class="table-container">
    @if($users->count() > 0)
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @foreach($users as $u)
                <tr class="user-row">
                    <td data-label="Nombre">
                        <strong>{{ $u->nombre }} {{ $u->primerApellido }} {{ $u->segundoApellido }}</strong>
                    </td>
                    <td data-label="Correo">
                        {{ $u->correo }}
                    </td>
                    <td data-label="Rol">
                        <span class="role-badge role-{{ strtolower($u->role->nombre) }}">
                            {{ $u->role->nombre }}
                        </span>
                    </td>
                    <td data-label="Acciones" class="actions-cell" style="text-align: center;">
                        <a href="{{ route('users.edit', $u) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>
                        <form method="POST" action="{{ route('users.destroy', $u) }}" style="display:inline" onsubmit="return confirm('¿Está seguro de eliminar este usuario?')">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <i class="fas fa-trash-alt"></i>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="no-results" id="noResults" style="display: none;">
            <i class="fas fa-search"></i>
            <h4>No se encontraron resultados</h4>
            <p>Intenta con otros términos de búsqueda</p>
        </div>
    @else
    <div class="empty-state">
        <i class="fas fa-users-slash"></i>
        <h4>No hay usuarios registrados</h4>
        <p>Comience agregando un nuevo usuario</p>
    </div>
    @endif
</div>

@if(method_exists($users, 'hasPages') && $users->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $users->links() }}
</div>
@endif
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const tableBody = document.getElementById('usersTableBody');
    const noResults = document.getElementById('noResults');
    const userRows = document.querySelectorAll('.user-row');

    // Función de búsqueda
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;

        // Mostrar/ocultar botón de limpiar
        if (searchTerm) {
            clearButton.classList.add('active');
        } else {
            clearButton.classList.remove('active');
        }

        // Filtrar filas
        userRows.forEach(row => {
            const nombre = row.querySelector('[data-label="Nombre"]').textContent.toLowerCase();
            const correo = row.querySelector('[data-label="Correo"]').textContent.toLowerCase();
            const rol = row.querySelector('[data-label="Rol"]').textContent.toLowerCase();

            if (nombre.includes(searchTerm) || correo.includes(searchTerm) || rol.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Mostrar mensaje de "no hay resultados"
        if (visibleCount === 0 && searchTerm) {
            tableBody.style.display = 'none';
            noResults.style.display = 'block';
        } else {
            tableBody.style.display = '';
            noResults.style.display = 'none';
        }
    });

    // Función para limpiar búsqueda
    function clearSearch() {
        searchInput.value = '';
        clearButton.classList.remove('active');
        userRows.forEach(row => {
            row.style.display = '';
        });
        tableBody.style.display = '';
        noResults.style.display = 'none';
        searchInput.focus();
    }
</script>
@endsection