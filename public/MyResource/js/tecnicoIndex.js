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
            const response = await fetch('/mis-tareas');
            const tasks = await response.json();
            console.log(tasks);
            tasks.forEach(task => {
                const categoriaNombre = task.categoria ? task.categoria.categoria : 'Sin categoría';
                addTask(task.id, task.titulo, task.descripcion, new Date(task.created_at).toLocaleString(), task.estado_id, categoriaNombre);
            });
        } catch (error) {
            console.error('Error al cargar las tareas:', error);
        }
    }
    

    // Cargar las tareas al cargar la página
    loadTasks();
});
