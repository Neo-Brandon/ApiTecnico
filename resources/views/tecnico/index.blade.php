@extends('layouts.app')

@section('content')

    <div class="">
        <div class="welcome">
            <h2><strong>Bienvenido Técnico</strong></h2>
            <p>Aquí puede revisar sus tareas</p>
        </div>
    
        <div class="task-container">
            <!-- Se añadirán tareas con ayuda del javascript aquí -->
        </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const taskContainer = document.querySelector('.task-container');

        // Función para agregar una nueva tarea
        function addTask(id, titulo, descripcion, timestamp, estado_id, categoria) {
            const taskCard = document.createElement('div');
            taskCard.classList.add('task-card');

            // Colorear el recuadro según el estado
            if (estado_id === 1) {
                taskCard.classList.add('pending'); // Rojo para Pendiente
            } else if (estado_id === 2) {
                taskCard.classList.add('completed'); // Verde para Completada
            } else if (estado_id === 3) {
                taskCard.classList.add('postponed'); // Azul para Pospuesta
            }

            // Crear elemento etiqueta de categoría y agregar la clase según el estado
            const categoryElement = document.createElement('div');
            categoryElement.classList.add('category');
            if (estado_id === 1) {
                categoryElement.classList.add('category-pending'); // Clase para Pendiente
            } else if (estado_id === 2) {
                categoryElement.classList.add('category-completed'); // Clase para Completada
            } else if (estado_id === 3) {
                categoryElement.classList.add('category-postponed'); // Clase para Pospuesta
            }
            categoryElement.textContent = categoria;

            taskCard.innerHTML = `
                <div class="task-header">
                    <div class="timestamp">${timestamp}</div>
                </div>
                <h2>${titulo}</h2>
                <p class="description">${descripcion}</p>
            `;

            // Insertar el elemento de categoría en el encabezado de la tarjeta
            taskCard.querySelector('.task-header').appendChild(categoryElement);

            // Añadir evento de clic para redireccionar a la página de la tarea
            taskCard.addEventListener('click', () => {
                window.location.href = `/tareas/${id}`; // Ruta de Laravel
            });

            taskContainer.prepend(taskCard);
        }

        // Función para cargar tareas desde la base de datos
        async function loadTasks() {
            try {
                const response = await fetch('/api/tareas');
                const tasks = await response.json();
                console.log(tasks);
                tasks.forEach(task => {
                    // Asegúrate de acceder al nombre de la categoría
                    const categoriaNombre = task.categoria ? task.categoria.categoria : 'Sin categoría';
                    addTask(task.id,task.titulo, task.descripcion, new Date(task.created_at).toLocaleString(), task.estado_id, categoriaNombre);
                });
            } catch (error) {
                console.error('Error al cargar las tareas:', error);
            }
        }

        // Cargar las tareas al cargar la página
        loadTasks();
    });

    </script>

    <style>
        .task-card {
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa; /* Color base */
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .category-pending {
            background-color: #6c757d; /* Color de fondo de la categoría */
            color: white;
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 12px;
        }

        .category-completed {
            background-color:#5aa039; /* Color de fondo de la categoría */
            color: white;
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 12px;
        }

        .category-postponed {
            background-color: #ffff5d; /* Color de fondo de la categoría */
            color: white;
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 12px;
        }

        .timestamp {
            font-size: 12px;
            color: #6c757d;
            display: flex;
            flex-direction: column; /* Muestra la fecha y la hora en líneas separadas */
        }

        .task-card h2 {
            margin: 10px 0 5px;
            font-size: 18px;
        }

        .description {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
            color: #495057;
        }

        /* Colores según el estado */
        .pending {
            background-color: #dfdfdf; /* Gris */
        }

        .completed {
            background-color: #bafa9c; /* Verde */
        }

        .postponed {
            background-color: #ffff5d; /* Amarillo */
        }

        .task-card:hover {
            transform: scale(1.01); /* Agranda el recuadro ligeramente */
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2); /* Aumenta el efecto de sombra */
        }

    /* Estilos específicos para pantallas pequeñas */
    @media (max-width: 600px) {
        .task-header {
            flex-direction: column; /* Cambia la dirección del flex a columna */
            align-items: flex-start; /* Alinea los elementos al inicio */
        }

        .timestamp {
            margin-bottom: 5px; /* Añade un margen inferior para separarlo de la categoría */
        }

        .category {
            align-self: flex-end; /* Alinea la categoría a la derecha */
        }
    }

    /* Estilos específicos para pantallas pequeñas */
    @media (max-width: 600px) {
        .task-header {
            flex-direction: column; /* Cambia la dirección del flex a columna */
            align-items: flex-start; /* Alinea los elementos al inicio */
        }

        .category {
            align-self: flex-start; /* Alinea la categoría a la izquierda */
            margin-bottom: 5px; /* Añade un margen inferior para separarlo de la fecha/hora */
        }

        .timestamp {
            align-self: flex-start; /* Alinea la fecha/hora también a la izquierda para consistencia */
        }
    }
    </style>

@endsection
