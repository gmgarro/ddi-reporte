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
        grid-template-columns: repeat(2, 1fr);
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

    .form-control.is-invalid {
        border-color: #c62828;
        background: #ffebee;
    }

    .form-control.is-invalid:focus {
        border-color: #c62828;
        box-shadow: 0 0 0 3px rgba(198, 40, 40, 0.1);
    }

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 45px;
    }

    .form-hint {
        font-size: 13px;
        color: #999;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .invalid-feedback {
        font-size: 13px;
        color: #c62828;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        border: none;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .alert-danger {
        background: #ffebee;
        color: #c62828;
    }

    .alert-danger .alert-icon {
        font-size: 1.2rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 1.5rem;
        flex: 1;
    }

    .alert-danger li {
        margin: 0.25rem 0;
    }

    /* Transiciones suaves para segundo valor */
    #segundoValorGroup {
        transition: all 0.3s ease;
        overflow: hidden;
    }

    #segundoValorGroup.hidden {
        max-height: 0;
        opacity: 0;
        margin-bottom: 0;
        pointer-events: none;
    }

    #segundoValorGroup:not(.hidden) {
        max-height: 200px;
        opacity: 1;
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

<!-- Información del Ajuste -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-sliders-h"></i>
        Información del Ajuste
    </h3>

    <div class="form-group">
        <label class="form-label required">Nombre del Parámetro</label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-tag"></i></span>
            <input 
                type="text"
                name="nombre"
                id="nombre"
                class="form-control"
                value="{{ old('nombre', $ajusteParametro->nombre ?? '') }}"
                placeholder="Ej: Temperatura Máxima, Presión, etc."
                required
            >
        </div>
        <small class="form-hint">
            <i class="fas fa-info-circle"></i>
            Ingrese un nombre descriptivo para el parámetro
        </small>
    </div>

    <div class="form-group">
        <label class="form-label required">Tipo de Ajuste</label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-cog"></i></span>
            <select name="tipo" id="tipo" class="form-control" required>
                @php
                    $tipoSeleccionado = old('tipo', $ajusteParametro->tipo ?? '');
                @endphp
                <option value="">Seleccione un tipo</option>
                <option value="MAYOR_QUE" {{ $tipoSeleccionado == 'MAYOR_QUE' ? 'selected' : '' }}>
                    Mayor o igual que (>=)
                </option>
                <option value="MENOR_QUE" {{ $tipoSeleccionado == 'MENOR_QUE' ? 'selected' : '' }}>
                    Menor o igual que (<=)
                </option>
                <option value="ENTRE" {{ $tipoSeleccionado == 'ENTRE' ? 'selected' : '' }}>
                    Entre (rango)
                </option>
            </select>
        </div>
    </div>
</div>

<!-- Valores del Ajuste -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-calculator"></i>
        Valores del Parámetro
    </h3>

    <div class="form-row">
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label required" id="primerValorLabel">Primer Valor</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-hashtag"></i></span>
                <input 
                    type="number"
                    step="0.01"
                    name="primerValor"
                    id="primerValor"
                    class="form-control"
                    value="{{ old('primerValor', $ajusteParametro->primerValor ?? '') }}"
                    placeholder="0.00"
                    required
                >
            </div>
            <small class="form-hint" id="primerValorHint">
                <i class="fas fa-info-circle"></i>
                <span id="primerValorHintText">Ingrese el valor del parámetro</span>
            </small>
        </div>

        <div class="form-group" id="segundoValorGroup" style="margin-bottom: 0;">
            <label class="form-label required">Segundo Valor</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-hashtag"></i></span>
                <input 
                    type="number"
                    step="0.01"
                    name="segundoValor"
                    id="segundoValor"
                    class="form-control"
                    value="{{ old('segundoValor', $ajusteParametro->segundoValor ?? '') }}"
                    placeholder="0.00"
                >
            </div>
            <small class="form-hint">
                <i class="fas fa-info-circle"></i>
                Ingrese el valor máximo del rango
            </small>
        </div>
    </div>
</div>

<script>
    const tipoSelect = document.getElementById('tipo');
    const segundoValorGroup = document.getElementById('segundoValorGroup');
    const segundoValorInput = document.getElementById('segundoValor');
    const primerValorInput = document.getElementById('primerValor');
    const primerValorLabel = document.getElementById('primerValorLabel');
    const primerValorHintText = document.getElementById('primerValorHintText');

    // Función para actualizar la visibilidad y labels según el tipo
    function updateFormByType() {
        const tipo = tipoSelect.value;

        // Actualizar visibilidad del segundo valor
        if (tipo === 'ENTRE') {
            segundoValorGroup.classList.remove('hidden');
            segundoValorInput.setAttribute('required', 'required');
            primerValorLabel.textContent = 'Valor Mínimo';
            primerValorHintText.textContent = 'Ingrese el valor mínimo del rango';
        } else {
            segundoValorGroup.classList.add('hidden');
            segundoValorInput.removeAttribute('required');
            segundoValorInput.value = ''; // Limpiar el valor cuando se oculta
            
            if (tipo === 'MAYOR_QUE') {
                primerValorLabel.textContent = 'Valor de Referencia';
                primerValorHintText.textContent = 'El parámetro debe ser mayor que este valor';
            } else if (tipo === 'MENOR_QUE') {
                primerValorLabel.textContent = 'Valor de Referencia';
                primerValorHintText.textContent = 'El parámetro debe ser menor que este valor';
            } else {
                primerValorLabel.textContent = 'Primer Valor';
                primerValorHintText.textContent = 'Ingrese el valor del parámetro';
            }
        }
    }

    // Validación en tiempo real para el tipo ENTRE
    function validateRange() {
        const tipo = tipoSelect.value;
        
        if (tipo === 'ENTRE') {
            const primerValor = parseFloat(primerValorInput.value);
            const segundoValor = parseFloat(segundoValorInput.value);

            // Limpiar estados previos
            primerValorInput.classList.remove('is-invalid');
            segundoValorInput.classList.remove('is-invalid');
            
            // Remover mensajes de error previos
            const prevErrors = document.querySelectorAll('.invalid-feedback');
            prevErrors.forEach(error => error.remove());

            if (!isNaN(primerValor) && !isNaN(segundoValor)) {
                if (segundoValor <= primerValor) {
                    segundoValorInput.classList.add('is-invalid');
                    
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'invalid-feedback';
                    errorMsg.innerHTML = '<i class="fas fa-exclamation-triangle"></i> El segundo valor debe ser mayor que el primero';
                    segundoValorInput.parentElement.parentElement.appendChild(errorMsg);
                    
                    return false;
                }
            }
        }
        return true;
    }

    // Validación del formulario antes de enviar
    function validateForm(event) {
        const tipo = tipoSelect.value;
        let isValid = true;
        
        // Limpiar estados previos
        document.querySelectorAll('.form-control').forEach(input => {
            input.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(error => error.remove());

        // Validar nombre
        if (!document.getElementById('nombre').value.trim()) {
            showError(document.getElementById('nombre'), 'El nombre es requerido');
            isValid = false;
        }

        // Validar tipo
        if (!tipo) {
            showError(tipoSelect, 'Debe seleccionar un tipo de ajuste');
            isValid = false;
        }

        // Validar primer valor
        const primerValor = parseFloat(primerValorInput.value);
        if (isNaN(primerValor) || primerValorInput.value.trim() === '') {
            showError(primerValorInput, 'El primer valor es requerido');
            isValid = false;
        }

        // Validar segundo valor si es tipo ENTRE
        if (tipo === 'ENTRE') {
            const segundoValor = parseFloat(segundoValorInput.value);
            
            if (isNaN(segundoValor) || segundoValorInput.value.trim() === '') {
                showError(segundoValorInput, 'El segundo valor es requerido para tipo ENTRE');
                isValid = false;
            } else if (!isNaN(primerValor) && segundoValor <= primerValor) {
                showError(segundoValorInput, 'El segundo valor debe ser mayor que el primero');
                isValid = false;
            }
        }

        if (!isValid) {
            event.preventDefault();
            
            // Scroll al primer error
            const firstError = document.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }

        return isValid;
    }

    // Función para mostrar errores
    function showError(input, message) {
        input.classList.add('is-invalid');
        
        const errorMsg = document.createElement('div');
        errorMsg.className = 'invalid-feedback';
        errorMsg.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
        input.parentElement.parentElement.appendChild(errorMsg);
    }

    // Event Listeners
    tipoSelect.addEventListener('change', updateFormByType);
    primerValorInput.addEventListener('input', validateRange);
    segundoValorInput.addEventListener('input', validateRange);

    // Validar al enviar el formulario
    document.querySelector('form').addEventListener('submit', validateForm);

    // Inicializar el estado del formulario
    updateFormByType();
</script>