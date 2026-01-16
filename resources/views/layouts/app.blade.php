<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrativo')</title>
      <link rel="icon" href="{{ asset('img/LogoBlanco.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }

        /* Top Navbar */
        .top-navbar {
            background: #1b4282;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1.5rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .menu-toggle {
            background: none;
            border: none;
            color: white;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle:hover {
            opacity: 0.8;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: white !important;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 45px;
            margin-right: 15px;
            filter: brightness(0) invert(1);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100vh;
            background: #1b4282;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.2);
            transition: left 0.3s ease;
            z-index: 1100;
            overflow-y: auto;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .sidebar-logo img {
            height: 40px;
            margin-right: 12px;
            filter: brightness(0) invert(1);
        }

        .close-sidebar {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .close-sidebar:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            list-style: none;
            margin: 0.25rem 0;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.9rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .menu-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-left: 4px solid white;
        }

        .menu-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.8rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            border-color: rgba(255, 255, 255, 0.5);
        }

        .btn-logout i {
            width: 20px;
            text-align: center;
        }

        /* Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Main Content */
        .main-content {
            margin-top: 70px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
        }

        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .main-content {
                padding: 1rem;
            }

            .content-card {
                padding: 1.5rem;
            }

            .navbar-brand img {
                height: 35px;
            }

            .navbar-brand span {
                font-size: 0.95rem;
            }

            .sidebar {
                width: 280px;
                left: -280px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Top Navbar -->
    <nav class="top-navbar">
        <button class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="/img/LogoBlanco.png" alt="Logo Empresa">
            <span>Panel Administrativo</span>
        </a>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="/img/LogoBlanco.png" alt="Logo">
                <span>Menú</span>
            </div>
            <button class="close-sidebar" onclick="toggleSidebar()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-item">
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                     <i class="fas fa-map-marked-alt"></i>
                    <span>Mapa</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link {{ request()->routeIs('tareas.calendario') ? 'active' : '' }}" href="{{ route('tareas.calendario') }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Calendario</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link {{ request()->routeIs('equipos.*') ? 'active' : '' }}" href="{{ route('equipos.index') }}">
                    <i class="fas fa-tools"></i>
                    <span>Equipos</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link {{ request()->routeIs('ajuste_parametros.*') ? 'active' : '' }}" href="{{ route('ajuste_parametros.index') }}">
                    <i class="fas fa-sliders-h"></i>
                    <span>Ajustes parametros</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="fas fa-user-cog"></i>  
                    <span>Usuarios</span>
                </a>
            </li>
            
            
            <!-- Aquí puedes agregar más opciones -->
            <!--
            <li class="menu-item">
                <a class="menu-link" href="#">
                    <i class="fas fa-cog"></i>
                    <span>Configuración</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="#">
                    <i class="fas fa-file-alt"></i>
                    <span>Reportes</span>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="#">
                    <i class="fas fa-box"></i>
                    <span>Productos</span>
                </a>
            </li>
            -->
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Cerrar sidebar al hacer clic en un enlace (opcional, mejora UX en móviles)
        document.querySelectorAll('.menu-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });
        });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>