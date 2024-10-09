document.addEventListener('DOMContentLoaded', () => {
    const taskContainer = document.querySelector('.task-container');

    // Función para agregar una nueva tarea
    function addTask(title, description, timestamp) {
        const taskCard = document.createElement('div');
        taskCard.classList.add('task-card');

        taskCard.innerHTML = `
            <h2>${Titulo}</h2>
            <p>${descripcion}</p>
            <div class="timestamp">${timestamp}</div>
        `;

        taskContainer.prepend(taskCard);
    }

    // Función para cargar tareas desde la base de datos
    async function loadTasks() {
        try {
            const response = await fetch('/tareas');
            const tasks = await response.json();

            tasks.forEach(task => {
                addTask(task.title, task.description, new Date(task.created_at).toLocaleString());
            });
        } catch (error) {
            console.error('Error al cargar las tareas:', error);
        }
    }

    // Cargar las tareas al cargar la página
    loadTasks();
});
