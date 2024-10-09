@extends('layouts.app')

@section('content')

    <div class="">
        <div class="welcome">
            <h2><strong>Bienvenido Tecnico</strong></h2>
            <p>Aqui puede revisar sus tareas</p>
        </div>
    
        <div class="task-container">
            <!-- Aquí se agregarán las tareas dinámicamente -->
        </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const taskContainer = document.querySelector('.task-container');

    // Función para agregar una nueva tarea
    function addTask(titulo, descripcion, timestamp) {
        const taskCard = document.createElement('div');
        taskCard.classList.add('task-card');

        taskCard.innerHTML = `
            <h2>${titulo}</h2>
            <p>${descripcion}</p>
            <div class="timestamp">${timestamp}</div>
        `;

        taskContainer.prepend(taskCard);
    }

    // Función para cargar tareas desde la base de datos
    async function loadTasks() {
        try {
            const response = await fetch('/api/tareas');
            const tasks = await response.json();

            tasks.forEach(task => {
                addTask(task.titulo, task.descripcion, new Date(task.created_at).toLocaleString());
            });
        } catch (error) {
            console.error('Error al cargar las tareas:', error);
        }
    }

    // Cargar las tareas al cargar la página
    loadTasks();
});

    </script>
@endsection