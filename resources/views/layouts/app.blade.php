<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>AppTecnico</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> -->

    <!-- <script src="../bootstrap/js/bootstrap.bundle.min.js"></script> -->
</head>
<style>
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
        background-color: #7495E9; /* Color de fondo personalizado */
        color: white;              /* Color del texto */
        border: none;
    }

    .my-custom-btn:hover {
        background-color: #5d77b8; /* Color al hacer hover */
        color: #ffffff;              /* Color del texto */
    }

    .my-custom-input {
        background-color: #d2dbf3; /* Color de fondo personalizado */
        color: #ffffff;              /* Color del texto */
    }

    .my-custom-input:focus {
        background-color: #99a2b9; /* Color de fondo cuando se hace foco en el input */
        outline: none;             /* Quitar borde de enfoque predeterminado */
        box-shadow: 0 0 5px rgba(255, 235, 59, 0.5); /* Efecto visual al enfocarse */
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
    <div id="contenido" name="contenido" class="">
        <div class=""> <!-- Header-->
            <div class=""> <!-- Si queremos dividir el contenido en un submenus habra que agregar otro-->
                @yield('content') <!--Contenido: comando propio de Larabel-->
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
