<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 20px;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/img/login/fondo2.webp') center/cover no-repeat;
            opacity: 100;
            z-index: 0;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px 40px;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 0px;
        }

        .logo-container img {
            max-width: 150px;
            height: auto;
            margin-bottom: 5px;
        }

        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            padding: 12px 45px 12px 45px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            background: #fafafa;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: #8edfe2;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(142, 223, 226, 0.25);
            outline: none;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #999;
            z-index: 10;
            pointer-events: none;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #999;
            z-index: 10;
            transition: color 0.3s;
            user-select: none;
        }

        .toggle-password:hover {
            color: #6ab1bb;
        }

        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #5299d4 0%, #1b4282 100%);
            border: none;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            border-radius: 10px;
            color: white;
            box-shadow: 0 4px 15px rgba(142, 223, 226, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(106, 177, 187, 0.6);
            background: linear-gradient(135deg, #1b4282 0%, #5299d4 100%);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Responsivo */
        @media (max-width: 576px) {
            .login-card {
                padding: 40px 30px;
            }

            .logo-container h2 {
                font-size: 24px;
            }

            .form-control {
                padding: 12px 40px 12px 40px;
            }
        }

        @media (max-width: 400px) {
            body {
                padding: 15px;
            }

            .login-card {
                padding: 30px 25px;
            }

            .logo-container img {
                max-width: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <!-- Cambia el src por la ruta de tu logo -->
                <img src="/img/Logo.png" alt="Logo Empresa">
            </div>

            <form method="POST" action="/login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                @if($errors->has('login'))
                    <p class="small mb-2" style="color: #780000;">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first('login') }}
                    </p>
                @endif



                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <span class="input-icon"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@grupoddi.com" value="{{ old('correo') }}" required>
                    </div>
                </div>

                <div class="mb-4">
    <label for="password" class="form-label">Contraseña</label>
    <div class="input-wrapper">
        <span class="input-icon">
            <i class="fa-solid fa-lock"></i>
        </span>

        <input 
            type="password" 
            class="form-control" 
            id="password" 
            name="password" 
            placeholder="Ingrese su contraseña" 
            value="{{ old('password') }}"
            required
        >

        <span 
            class="toggle-password" 
            onclick="togglePassword()" 
            title="Mostrar / Ocultar contraseña"
        >
            <i class="fa-solid fa-eye"></i>
        </span>
    </div>
</div>


                <button type="submit" class="btn btn-primary">
                    Iniciar Sesión
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');

            // animación
            toggleIcon.classList.add('animate');

            setTimeout(() => {
                toggleIcon.classList.remove('animate');
            }, 250);

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

</body>
</html>