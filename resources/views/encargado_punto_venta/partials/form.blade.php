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

    .form-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
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

    /* Responsive */
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

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

<!-- Información del Encargado -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-user"></i>
        Información del Encargado
    </h3>

    <div class="form-row">
        <!-- Nombre -->
        <div class="form-group">
            <label class="form-label required">Nombre</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-user"></i></span>
                <input
                    type="text"
                    name="nombre"
                    class="form-control"
                    placeholder="Nombre completo"
                    value="{{ old('nombre', $encargadoPuntoVenta->nombre ?? '') }}"
                    required
                >
            </div>
        </div>

        <!-- Correo -->
        <div class="form-group">
            <label class="form-label required">Correo Electrónico</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-envelope"></i></span>
                <input
                    type="email"
                    name="correo"
                    class="form-control"
                    placeholder="correo@ejemplo.com"
                    value="{{ old('correo', $encargadoPuntoVenta->correo ?? '') }}"
                    required
                >
            </div>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label class="form-label required">Teléfono</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-phone"></i></span>
                <input
                    type="text"
                    name="telefono"
                    class="form-control"
                    placeholder="8888-8888"
                    value="{{ old('telefono', $encargadoPuntoVenta->telefono ?? '') }}"
                    required
                >
            </div>
        </div>
    </div>
</div>
