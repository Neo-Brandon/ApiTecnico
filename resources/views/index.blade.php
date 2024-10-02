<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    
    <style>
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
            right: -250px; /* Oculto fuera de la pantalla por el lado derecho */
            top: 0;
            height: 100%;
            width: 250px;
            background-color: #333;
            color: white;
            padding: 20px;
            transition: right 0.3s ease; /* Cambia 'left' por 'right' */
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
            display: none; /* Oculto por defecto */
            z-index: 5;
        }


        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
        }


    </style>
</head>
<body>

    <header>
        <h1>Inicio</h1>
        <div class="menu-icon">&#9776;</div>
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    </header>
    
    <!-- Menú desplegable-->
    <div class="sidebar" id="sidebar">
        <a href="#">Dashboard</a>
        <a href="#">Asignar Tarea</a>
        <a href="#">Comprobar Tareas</a>
        <a href="#">Estadísticas</a>
        <a href="#">Ayuda</a>
    </div>

    <!-- Overlay para cerrar el menú al hacer clic fuera -->
    <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

    <div class="container">
        <div class="welcome">
            <h2><strong>Bienvenido Administrador</strong></h2>
            <p>Toque cualquier recuadro para desplegar</p>
        </div>

        <div class="grid">
            <div class="grid-item">
                <img src="{{ asset('icons/tarea.png') }}" alt="Asignar Tarea">
                <p>Asignar tarea</p>
            </div>
            <div class="grid-item">
                <img src="{{ asset('icons/ojo.png') }}" alt="Comprobar Tareas">
                <p>Comprobar tareas</p>
            </div>
            <div class="grid-item">
                <img src="{{ asset('icons/estadistica.png') }}" alt="Estadísticas">
                <p>Estadísticas</p>
            </div>
            <div class="grid-item">
                <img src="{{ asset('icons/agregar.png') }}" alt="Añadir">
                <p>Añadir</p>
            </div>
            <div class="grid-item">
                <img src="{{ asset('icons/ayuda.png') }}" alt="Ayuda">
                <p>Ayuda</p>
            </div>
        </div>
    </div>
    <script>
        function toggleMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            if (sidebar.style.right === '-250px') {
                sidebar.style.right = '0'; // Muestra el menú desde el lado derecho
                overlay.style.display = 'block'; // Muestra el overlay
            } else {
                sidebar.style.right = '-250px'; // Oculta el menú
                overlay.style.display = 'none'; // Oculta el overlay
            }
        }

    </script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
