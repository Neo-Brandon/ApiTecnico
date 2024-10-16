<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <style>
        .w-90 {
            width: 90% !important;
        }

        .w-95 {
            width: 95% !important;
        }

        /* Estilo para el botón */
        .sub-btn-w {
            text-decoration: none;
            /* Subrayado */
            color: white;
            /* Color del texto (negro) */

        }

        .marg-crud {
            margin-left: 15pt;
        }

        .marg-top {
            margin-left: 15pt;
            margin-top: 15pt;
        }

        .pd-left {
            padding-left: 15pt;
        }

        .form-padding {
            padding-top: 0pt;
            padding-left: 480px;
        }

        .td-w-especialidad {
            width: 450px;
        }

        .td-w-medio {
            width: 150px;
        }

        .td-w-normal {
            width: 250px;
        }

        .save-btn {
            margin-top: 20pt;
        }

        .agregar-btn {
            margin-top: 20pt;
            margin-left: 20pt;
        }

        .titulos {
            padding-left: 15pt;
        }

        /*h1 {
                margin-left: 15pt;
                margin-top: 15pt;
            }
        */
        label,
        input {
            padding-top: 15pt;

        }

        .my-custom-btn {
            background-color: #7495E9;
            /* Color de fondo personalizado */
            color: white;
            /* Color del texto */
            border: none;
        }

        .my-custom-btn:hover {
            background-color: #5d77b8;
            /* Color al hacer hover */
            color: #ffffff;
            /* Color del texto */
        }

        .my-custom-input {
            background-color: #d2dbf3;
            /* Color de fondo personalizado */
            color: #201e1e;
            /* Color del texto */
        }

        .my-custom-input:focus {
            background-color: #99a2b9;
            /* Color de fondo cuando se hace foco en el input */
            outline: none;
            /* Quitar borde de enfoque predeterminado */
            box-shadow: 0 0 5px rgba(255, 235, 59, 0.5);
            /* Efecto visual al enfocarse */
        }

        input {
            background-color: #d2dbf3;
            /* Color de fondo personalizado */
            color: #201e1e;
            /* Color del texto */
        }

        input:focus {
            background-color: #99a2b9;
            /* Color de fondo cuando se hace foco en el input */
            outline: none;
            /* Quitar borde de enfoque predeterminado */
            box-shadow: 0 0 5px rgba(255, 235, 59, 0.5);
            /* Efecto visual al enfocarse */
        }

        /*-------------------------------------------------------------------------------*/

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 40vh;
        }

        header {
            background-color: white;
            width: %;
            padding: 20px;
            text-align: left;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        header .menu-icon {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 30px;
            cursor: pointer;
        }

        .welcome {
            margin: 20px 0;
            text-align: center;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            padding: 10px;
        }

        .grid-item {
            background-color: #7c9ed3;
            color: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .grid-item:hover {
            transform: scale(1.05);
        }

        .grid-item img {
            width: 70px;
            height: 70px;
        }

        .grid-item p {
            margin-top: 10px;
            font-size: 18px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            right: -250px;
            /* Oculto fuera de la pantalla por el lado derecho */
            top: 0;
            height: 100%;
            width: 250px;
            background-color: #333;
            color: white;
            padding: 20px;
            transition: right 0.3s ease;
            /* Cambia 'left' por 'right' */
            z-index: 10;
        }

        /* Overlay para cerrar el menú al hacer clic fuera */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            /* Oculto por defecto */
            z-index: 5;
        }


        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
        }

        a {
            text-decoration: none;
            /* Elimina el subrayado */
            color: inherit;
            /* Mantiene el color actual del texto o imagen */
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
                /* Dos columnas en pantallas pequeñas */
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
                /* Dos columnas en pantallas medianas */
            }
        }

        /* Estilos tecnico ------------------------------------------------------------------------------*/


        .task-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
        }

        .task-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 1rem 0;
            padding: 1rem;
            width: 80%;
        }

        .task-card h2 {
            margin: 0 0 0.5rem 0;
        }

        .task-card p {
            margin: 0.5rem 0;
        }

        .task-card .timestamp {
            color: #888;
            font-size: 0.9rem;
            text-align: right;
        }

        .dropdown-menu {
            right: 0;
            left: auto; /* Evita que el menú se posicione a la izquierda */
            transform: translateX(-30px); /* Ajusta el desplazamiento horizontal */
            z-index: 2000; /* Asegúrate de que el menú desplegable esté sobre otros elementos */
        }

    </style>

    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <header class="container-fluid d-flex justify-content-between align-items-center p-3 bg-white shadow-sm">
        <h1 class="h3">Inicio</h1>
        <nav class="d-flex align-items-center">
            <div class="dropdown me-5"> <!-- Agregando margen derecho -->
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::check() ? Auth::user()->name : 'Invitado' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
            <button class="btn btn-light d-sm-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse" id="navbarResponsive">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                </ul>
                <div class="border-top mt-3 pt-3">
                    @if (Auth::check())
                        <div>
                            <div class="fw-bold">{{ Auth::user()->name }}</div>
                            <div class="text-muted">{{ Auth::user()->email }}</div>
                        </div>
                    @else
                        <div>
                            <div class="fw-bold">Invitado</div>
                            <div class="text-muted">Sin correo</div>
                        </div>
                    @endif
                    <ul class="list-group mt-3">
                        <li class="list-group-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        </li>
                        <li class="list-group-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    </header>
    


        <!-- Menú lateral (sidebar) -->
    <div class="sidebar d-none d-md-block" id="sidebar">
        <a href="#" class="text-white">Dashboard</a>
        <a href="#" class="text-white">Asignar Tarea</a>
        <a href="#" class="text-white">Comprobar Tareas</a>
        <a href="#" class="text-white">Estadísticas</a>
        <a href="#" class="text-white">Ayuda</a>
    </div>


    <!-- Overlay para cerrar el menú al hacer clic fuera -->
    <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

    <div id="contenido" name="contenido" class="">
        <div> <!-- Header-->
            <div> <!-- Si queremos dividir el contenido en un submenus habra que agregar otro-->
                @yield('content') <!--Contenido: comando propio de Larabel-->
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
    
            // Establecer estado inicial del menú oculto
            sidebar.style.right = '-250px';
            overlay.style.display = 'none';
    
            // Añadir evento al icono de menú
            const menuIcons = document.getElementsByClassName('menu-icon');
            for (let i = 0; i < menuIcons.length; i++) {
                menuIcons[i].addEventListener('click', toggleMenu);
            }
    
            // Añadir evento al overlay para cerrar el menú
            overlay.addEventListener('click', closeMenu);
    
            function toggleMenu() {
                if (sidebar.style.right === '-250px') {
                    sidebar.style.right = '0'; // Mostrar el sidebar
                    overlay.style.display = 'block'; // Mostrar el overlay
                } else {
                    closeMenu(); // Llamar a la función de cerrar el menú
                }
            }
    
            function closeMenu() {
                sidebar.style.right = '-250px'; // Ocultar el sidebar
                overlay.style.display = 'none'; // Ocultar el overlay
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    </div>
</body>

</html>
