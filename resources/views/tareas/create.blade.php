@extends('layouts.app')

@section('content')
  
<style>
    .badge {
        display: inline-block;
        margin-bottom: 5px;
        cursor: pointer;
    }

</style>
    <div class=" container-xxl d-flex justify-content-center">
        <!-- Ajustes para la responsividad de la pagina-->
        <div class="col-12 col-md-8 col-lg-6"> <!-- Ajusta el tamaño dependiendo del dispositivo -->
            <div class="welcome text-center">
                <h2><strong>Registrar Tarea</strong></h2>
                <p>Registre una nueva tarea para algun técnico</p>
            </div>

            <form action="{{ route('tarea.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label">Titulo de la tarea:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control">
                    @error('titulo')
                        <div class="alert alert-danger">Debe escribirse un titulo</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" placeholder="Describa la tarea a realizar" name="descripcion" class="form-control"></textarea>
                    @error('descripcion')
                        <div class="alert alert-danger">Debe escribirse una descripcion</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="col-sm-6">
                        <label for="categoria_id" class="form-label">Categoría de la tarea:</label>
                        <select class="form-select" id="categoria_id" name="categoria_id">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectUsersModal">
                    Seleccionar Usuarios
                </button>

                <!-- Modal de Bootstrap -->
                <div class="modal fade" id="selectUsersModal" tabindex="-1" aria-labelledby="selectUsersModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="selectUsersModalLabel">Seleccionar Usuarios</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Select Multiple con Select2 -->
                                <label for="usuariosModal" class="form-label">Usuarios</label>
                                <select class="form-select" id="usuariosModal" multiple>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardarSeleccion">Guardar selección</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenedor donde se mostrarán los usuarios seleccionados como etiquetas -->
                <div class="mt-3">
                    <label for="usuariosSeleccionados" class="form-label">Usuarios Seleccionados</label>
                    <div id="usuariosSeleccionados" class="border p-2" style="min-height: 50px; max-width: 400px;">
                        <!-- Aquí aparecerán las etiquetas de usuarios seleccionados -->
                    </div>
                </div>

                <!-- Campo oculto para enviar los usuarios seleccionados en el formulario -->
                <input type="hidden" name="usuarios[]" id="usuariosSeleccionadosInput">

                &nbsp;
                <!-- Envolver el botón en un div con el mismo ancho que el input -->
                <div class="mb-3">
                    <button class="btn btn-primary w-100" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Cargar Select2 JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Iniciar Select2 en el modal
            $('#usuariosModal').select2({
                dropdownParent: $('#selectUsersModal'), // Hace que el dropdown se muestre dentro del modal
                placeholder: "Selecciona los usuarios",
                allowClear: true
            });

            // Cuando se guarda la selección
            $('#guardarSeleccion').click(function() {
                let selectedUsers = $('#usuariosModal').val(); // Obtener los valores seleccionados (IDs)
                let selectedTexts = $('#usuariosModal option:selected').map(function() {
                    return $(this).text(); // Obtener el texto de los usuarios seleccionados
                }).get();

                // Limpiar las etiquetas anteriores
                $('#usuariosSeleccionados').empty();

                // Guardar la selección en el campo oculto (para enviar en el formulario)
                $('#usuariosSeleccionadosInput').val(selectedUsers.join(','));
                console.log(selectedUsers);
                // Mostrar los usuarios seleccionados como etiquetas (chips)
                $.each(selectedUsers, function(index, value) {
                    let userName = selectedTexts[index];
                    $('#usuariosSeleccionados').append(
                        `<span class="badge bg-primary me-1">
                            ${userName} <span class="badge bg-secondary" style="cursor:pointer;" onclick="removeUser(${value}, this)">x</span>
                        </span>`
                    );
                });

                // Cerrar el modal
                $('#selectUsersModal').modal('hide');
            });
        });

        // Función para eliminar un usuario seleccionado
        function removeUser(userId, element) {
            // Remover la etiqueta visualmente
            $(element).parent().remove();

            // Remover el ID del campo oculto
            let selectedUsers = $('#usuariosSeleccionadosInput').val().split(',');
            selectedUsers = selectedUsers.filter(function(value) {
                return value != userId;
            });
            $('#usuariosSeleccionadosInput').val(selectedUsers);
        }
        //console.log($.fn.select2);
        //console.log(formData);


    </script>

@endsection
