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

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 45px;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        font-size: 18px;
        transition: color 0.3s;
        user-select: none;
    }

    .password-toggle:hover {
        color: #5299d4;
    }

    .form-hint {
        font-size: 13px;
        color: #999;
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

<!-- Información Personal -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-user"></i>
        Información Personal
    </h3>

    <div class="form-row">
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label required">Nombre</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-user"></i></span>
                <input 
                    type="text" 
                    name="nombre" 
                    class="form-control"
                    value="{{ old('nombre', $user->nombre ?? '') }}"
                    placeholder="Nombre"
                    required
                >
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label required">Primer Apellido</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-user"></i></span>
                <input 
                    type="text" 
                    name="primerApellido" 
                    class="form-control"
                    value="{{ old('primerApellido', $user->primerApellido ?? '') }}"
                    placeholder="Primer apellido"
                    required
                >
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label">Segundo Apellido</label>
            <div class="input-wrapper">
                <span class="input-icon"><i class="fas fa-user"></i></span>
                <input 
                    type="text" 
                    name="segundoApellido" 
                    class="form-control"
                    value="{{ old('segundoApellido', $user->segundoApellido ?? '') }}"
                    placeholder="Segundo apellido"
                >
            </div>
        </div>
    </div>
</div>

<!-- Información de Acceso -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-key"></i>
        Información de Acceso
    </h3>

    <div class="form-group">
        <label class="form-label required">Correo Electrónico</label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-envelope"></i></span>
            <input 
                type="email" 
                name="correo" 
                class="form-control"
                value="{{ old('correo', $user->correo ?? '') }}"
                placeholder="correo@ejemplo.com"
                required
            >
        </div>
    </div>

    <div class="form-group">
        <label class="form-label {{ isset($user) ? '' : 'required' }}">
            Contraseña {{ isset($user) ? '(dejar en blanco para mantener la actual)' : '' }}
        </label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-lock"></i></span>
            <input 
                type="password" 
                name="contrasena" 
                id="password"
                class="form-control"
                placeholder="{{ isset($user) ? 'Nueva contraseña (opcional)' : 'Ingrese una contraseña segura' }}"
                {{ isset($user) ? '' : 'required' }}
            >
            <span class="password-toggle" onclick="togglePassword()">
                <i class="fas fa-eye" id="toggleIcon"></i>
            </span>
        </div>
        @if(!isset($user))
        <small class="form-hint">
            <i class="fas fa-info-circle"></i>
            Mínimo 8 caracteres
        </small>
        @endif
    </div>

    <div class="form-group">
        <label class="form-label required">Rol</label>
        <div class="input-wrapper">
            <span class="input-icon"><i class="fas fa-user-tag"></i></span>
            <select name="rolId" class="form-control" required>
                <option value="">Seleccione un rol</option>
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}"
                        {{ old('rolId', $user->rolId ?? '') == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>