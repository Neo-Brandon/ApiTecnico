@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        /*box-shadow: 0 0 10px #6b91ce;*/
    }

    .section {
        margin-bottom: 20px;
        width: 100%;
    }

    label {
        font-size: 18px;
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #fff;
        background-color: #7c9ed3;
        padding: 8px;
        border-radius: 4px;
    }

    textarea, input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 18px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-top: 5px;
    }

    .flex-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        width: 100%;
        align-items: flex-start;
        flex-wrap: wrap; /* Permitir que los elementos se envuelvan si es necesario */
    }

    .flex-item {
        flex: 1;
        margin-right: 10px;
        min-width: 250px; /* Establece un ancho mínimo para evitar que los elementos se vuelvan demasiado pequeños */

    }

    #tecnicos-section {
        flex-grow: 2; /* Este elemento ocupará el doble de espacio */
    }

    .grid-item input {
        margin-top: 5px;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    textarea {
        resize: none;
    }
</style>

<div class="container-xxl d-flex flex-column justify-content-center align-items-center wd-90">
    <table class="" style="width: 80%">
        <tr>
            <td class="text-start" style="width: 33%;">
                <div class="mt-3">
                    <a class="btn my-custom-btn" href="{{ route('tarea.index', $tarea->id) }}">Regresar</a>
                </div>
            </td>
            <td class="text-center" style="width: 33%;">
                <div class="welcome">
                    <h2><strong>Mostrar Tarea</strong></h2>
                    <p>Visualice los datos de la tarea</p>
                </div>
            </td>
            <td class="text-end" style="width: 33%;">
                <div class="mt-3">
                    <a class="btn btn-success" href="{{ route('tarea.edit', $tarea->id) }}">Modificar</a>
                </div>
            </td>
        </tr>
    </table>

    <div class="container">
        <div class="flex-container">
            <div class="section grid-item flex-item">
                <label for="fechaPublica">Fecha de publicacion:</label>
                <input disabled id="fechaPublica" value="{{ $tarea->created_at->format('d/m/Y H:i') }}">
            </div>
    
            <div class="section grid-item flex-item">
                <label for="fechaTermina">Fecha de terminación:</label>
                <input disabled id="fechaTermina" value="{{ $tarea->completed_at ? $tarea->completed_at->format('d/m/Y H:i') : 'N/A' }}">
            </div>
        </div>

        <div class="section">
            <label for="titulo">Titulo:</label>
            <textarea disabled id="titulo" rows="2">{{ $tarea->titulo }}</textarea>
        </div>

        <div class="section">
            <label for="descripcion">Descripción:</label>
            <textarea disabled id="descripcion" rows="5">{{ $tarea->descripcion }}</textarea>
        </div>

        <div class="flex-container" style="width: 100%;">
            <div class="section flex-item" id="tecnicos-section">
                <label for="tecnicos">Técnicos:</label>
                <div id="tecnicos" class="form-control" style="min-height: 100px;">
                    @if($tarea->usuarios->isNotEmpty())
                        <ul>
                            @foreach ($tarea->usuarios as $usuario)
                                <li>{{ $usuario->nombre }}</li>
                            @endforeach
                        </ul>
                    @else
                        Sin encargado
                    @endif
                </div>
            </div>

            <div class="grid-item flex-item">
                <label for="categoria">Categoría:</label>
                <input disabled type="text" id="categoria" value="{{ $tarea->categoria->categoria ?? 'Sin categoría' }}">
            </div>

            <div class="grid-item flex-item">
                <label for="estado">Estado de la tarea:</label>
                <input disabled type="text" id="estado" value="{{ $tarea->estado->nombre_estado ?? 'Sin categoría' }}">
            </div>
        </div>

        <td class="text-end" style="width: 33%;">
            <div class="mt-3">
                <a class="btn btn-success" href="{{ route('tarea.edit', $tarea->id) }}">Reportar progreso</a>
            </div>
        </td>

        &nbsp;
        <div class="section">
            <label for="reportes">Reportes de tarea:</label>
            <textarea id="reportes" rows="5"></textarea>
        </div>
    </div>
</div>
@endsection
