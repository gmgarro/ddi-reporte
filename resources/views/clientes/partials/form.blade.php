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

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 45px;
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

<!-- Información del Cliente -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-building"></i>
        Información del cliente
    </h3>

    <div class="form-group">
        <label class="form-label required">Nombre del Cliente</label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-building"></i></span>
            <input 
                type="text" 
                name="nombre" 
                class="form-control"
                value="{{ old('nombre', $cliente->nombre ?? '') }}"
                placeholder="Ingrese el nombre del cliente"
                required
            >
        </div>
    </div>

    @if ($cliente->id!=null)
        <input type="hidden" name="paisId" value="{{ $cliente->paisId }}">
    @else
         <div class="form-group">
        <label class="form-label required">País</label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-globe"></i></span>
            <select name="paisId" class="form-control" required>
                <option value="">Seleccione un país</option>
                @foreach($paises as $pais)
                    <option value="{{ $pais->id }}"
                        {{ old('paisId', $cliente->paisId ?? '') == $pais->id ? 'selected' : '' }}>
                        {{ $pais->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

   

</div>