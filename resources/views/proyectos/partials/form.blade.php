<style>
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
        top: 15px;
        color: #999;
        font-size: 16px;
        pointer-events: none;
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

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
        font-family: inherit;
    }

    .form-hint {
        font-size: 13px;
        color: #999;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Herramientas Section */
    .herramientas-container {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .herramienta-item {
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .herramienta-item:hover {
        border-color: #5299d4;
        box-shadow: 0 2px 8px rgba(82, 153, 212, 0.1);
    }

    .herramienta-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e0e0e0;
    }

    .herramienta-title {
        font-weight: 600;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .herramienta-title i {
        color: #1b4282;
    }

    .btn-remove-herramienta {
        background: #ffebee;
        color: #c62828;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    .btn-remove-herramienta:hover {
        background: #c62828;
        color: white;
        transform: scale(1.1);
    }

    .herramienta-fields {
        display: grid;
        grid-template-columns: 2fr 1fr 2fr;
        gap: 1rem;
    }

    .field-group {
        display: flex;
        flex-direction: column;
    }

    .field-label {
        font-size: 12px;
        font-weight: 600;
        color: #666;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .field-input {
        padding: 10px 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .field-input:focus {
        outline: none;
        border-color: #5299d4;
        background: white;
        box-shadow: 0 0 0 3px rgba(82, 153, 212, 0.1);
    }

    .btn-add-herramienta {
        background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(82, 153, 212, 0.3);
        font-size: 14px;
    }

    .btn-add-herramienta:hover {
        background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(82, 153, 212, 0.4);
    }

    .empty-herramientas {
        text-align: center;
        padding: 2rem;
        color: #999;
        font-style: italic;
    }

    .empty-herramientas i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        opacity: 0.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .herramienta-fields {
            grid-template-columns: 1fr;
        }
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle alert-icon"></i>
        <div>
            <strong>Errores en el formulario:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<!-- Información del Proyecto -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-info-circle"></i>
        Información del Proyecto
    </h3>

    <div class="form-group">
        <label class="form-label required">Nombre del Proyecto</label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-project-diagram"></i></span>
            <input 
                type="text"
                name="nombre"
                class="form-control"
                value="{{ old('nombre', $proyecto->nombre ?? '') }}"
                placeholder="Ej: Implementación Sistema XYZ"
                required
            >
        </div>
        <small class="form-hint">
            <i class="fas fa-info-circle"></i>
            Ingrese un nombre descriptivo para el proyecto
        </small>
    </div>

    <div class="form-group">
        <label class="form-label required">Comentario / Descripción</label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-comment-alt"></i></span>
            <textarea 
                name="comentario"
                class="form-control"
                placeholder="Descripción detallada del proyecto, objetivos, alcance, etc."
                required
            >{{ old('comentario', $proyecto->comentario ?? '') }}</textarea>
        </div>
        <small class="form-hint">
            <i class="fas fa-info-circle"></i>
            Proporcione una descripción completa del proyecto
        </small>
    </div>
</div>

<!-- Herramientas del Proyecto -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-tools"></i>
        Herramientas del Proyecto
    </h3>

    <div class="herramientas-container">
        <div id="herramientas">
            @php
            $herramientas = old('herramientas', $proyecto->herramientas ?? []);
            @endphp

            @forelse ($herramientas as $i => $h)
            <div class="herramienta-item">
                @if(isset($h->id))
                    <input type="hidden" name="herramientas[{{ $i }}][id]" value="{{ $h->id }}">
                @endif

                <div class="herramienta-header">
                    <span class="herramienta-title">
                        <i class="fas fa-wrench"></i>
                        Herramienta #{{ $i + 1 }}
                    </span>
                    @if(isset($h->id))
                        <button 
                            type="button"
                            class="btn-remove-herramienta"
                            onclick="eliminarHerramientaAjax({{ $h->id }}, this)"
                            title="Eliminar herramienta"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    @else
                        <button 
                            type="button"
                            class="btn-remove-herramienta"
                            onclick="this.closest('.herramienta-item').remove(); actualizarNumeracion();"
                            title="Eliminar herramienta"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    @endif
                </div>

                <div class="herramienta-fields">
                    <div class="field-group">
                        <label class="field-label">Nombre *</label>
                        <input 
                            type="text"
                            class="field-input"
                            name="herramientas[{{ $i }}][nombre]"
                            value="{{ $h['nombre'] ?? $h->nombre }}"
                            placeholder="Ej: Taladro, Computadora, etc."
                            required
                        >
                    </div>

                    <div class="field-group">
                        <label class="field-label">Cantidad *</label>
                        <input 
                            type="number"
                            class="field-input"
                            name="herramientas[{{ $i }}][cantidad]"
                            value="{{ $h['cantidad'] ?? $h->cantidad }}"
                            min="1"
                            placeholder="0"
                            required
                        >
                    </div>

                    <div class="field-group">
                        <label class="field-label">Descripción</label>
                        <input 
                            type="text"
                            class="field-input"
                            name="herramientas[{{ $i }}][descripcion]"
                            value="{{ $h['descripcion'] ?? $h->descripcion }}"
                            placeholder="Especificaciones, marca, modelo..."
                        >
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-herramientas" id="emptyState">
                <i class="fas fa-tools"></i>
                <p>No hay herramientas agregadas aún</p>
            </div>
            @endforelse
        </div>

        <button 
            type="button"
            class="btn-add-herramienta"
            onclick="agregarHerramienta()"
        >
            <i class="fas fa-plus-circle"></i>
            Agregar Herramienta
        </button>
    </div>
</div>

<script>
let index = document.querySelectorAll('.herramienta-item').length;

function agregarHerramienta() {
    // Ocultar mensaje vacío si existe
    const emptyState = document.getElementById('emptyState');
    if (emptyState) {
        emptyState.remove();
    }

    const container = document.getElementById('herramientas');
    const numeroHerramienta = container.querySelectorAll('.herramienta-item').length + 1;
    
    const herramientaHTML = `
    <div class="herramienta-item" style="animation: slideIn 0.3s ease;">
        <div class="herramienta-header">
            <span class="herramienta-title">
                <i class="fas fa-wrench"></i>
                Herramienta #${numeroHerramienta}
            </span>
            <button 
                type="button"
                class="btn-remove-herramienta"
                onclick="this.closest('.herramienta-item').remove(); actualizarNumeracion();"
                title="Eliminar herramienta"
            >
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="herramienta-fields">
            <div class="field-group">
                <label class="field-label">Nombre *</label>
                <input 
                    type="text"
                    class="field-input"
                    name="herramientas[${index}][nombre]"
                    placeholder="Ej: Taladro, Computadora, etc."
                    required
                >
            </div>

            <div class="field-group">
                <label class="field-label">Cantidad *</label>
                <input 
                    type="number"
                    class="field-input"
                    name="herramientas[${index}][cantidad]"
                    min="1"
                    placeholder="0"
                    required
                >
            </div>

            <div class="field-group">
                <label class="field-label">Descripción</label>
                <input 
                    type="text"
                    class="field-input"
                    name="herramientas[${index}][descripcion]"
                    placeholder="Especificaciones, marca, modelo..."
                >
            </div>
        </div>
    </div>
    `;
    
    container.insertAdjacentHTML('beforeend', herramientaHTML);
    index++;
}

function eliminarHerramientaAjax(id, btn) {
    if (!confirm('¿Está seguro de eliminar esta herramienta?')) return;

    fetch(`/herramientas/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            btn.closest('.herramienta-item').remove();
            actualizarNumeracion();
            
            // Mostrar mensaje vacío si no quedan herramientas
            const container = document.getElementById('herramientas');
            if (container.querySelectorAll('.herramienta-item').length === 0) {
                container.innerHTML = `
                    <div class="empty-herramientas" id="emptyState">
                        <i class="fas fa-tools"></i>
                        <p>No hay herramientas agregadas aún</p>
                    </div>
                `;
            }
        } else {
            alert('Error al eliminar la herramienta');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al eliminar la herramienta');
    });
}

function actualizarNumeracion() {
    const herramientas = document.querySelectorAll('.herramienta-item');
    herramientas.forEach((item, index) => {
        const titulo = item.querySelector('.herramienta-title');
        if (titulo) {
            titulo.innerHTML = `<i class="fas fa-wrench"></i> Herramienta #${index + 1}`;
        }
    });
}

// Animación CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>