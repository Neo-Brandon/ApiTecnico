<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareaApiController extends Controller
{
    //
    public function index()
    {
        // Cargar tareas con sus categorías y usuarios
        $tareas = Tarea::with(['categoria', 'usuarios'])->get();

        // Verificar si no hay tareas
        if ($tareas->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron tareas',
                'status' => 404
            ], 404);
        }

        /*
        return response()->json([
            'tareas' => $tareas,
            'status' => 200
        ]);
        */

        return response()->json(
             $tareas
        );
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id', // Asegúrate de que la categoría existe
            'usuarios' => 'required|array', // Validar que venga un array de usuarios
            'usuarios.*' => 'exists:usuarios,id' // Validar que cada usuario exista en la tabla usuarios
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Crear la tarea con la categoría
        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id // Asignar la categoría
        ]);

        // Si la tarea no se crea correctamente
        if (!$tarea) {
            $data = [
                'message' => 'Error al crear la tarea',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // Asignar usuarios a la tarea
        $tarea->usuarios()->attach($request->usuarios); // Cambia 'tecnicos' por 'usuarios'

        // Respuesta de éxito
        $data = [
            'message' => 'Tarea creada exitosamente',
            'tarea' => $tarea,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
    
/*
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'titulo' => 'required|string',
            'descripcion' => 'required|text'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $tarea = Tarea::create([
            'tipo_tarea' => $request->tipo_tarea
        ]);

        if(!$tarea){
            $data = [
                'message' => 'Error al crear el tarea',
                'status' => '500'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'tarea' => $tarea,
            'status' => '201'
        ];
        return response()->json($data, 201);
    }
*/
public function show($id)
    {
        $tarea = Tarea::with(['categoria', 'usuarios'])->find($id);

        if (!$tarea) {
            return response()->json([
                'message' => 'Tarea no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'tarea' => $tarea,
            'status' => 200
        ]);
    }


    public function destroy($id)
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            return response()->json([
                'message' => 'Tarea no encontrada',
                'status' => 404
            ], 404);
        }

        $tarea->delete();

        return response()->json([
            'message' => 'Tarea eliminada con éxito',
            'status' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::with(['categoria', 'usuarios'])->find($id);
    
        if (!$tarea) {
            return response()->json([
                'message' => 'Tarea no encontrada',
                'status' => 404
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categoria,id',
            'usuarios' => 'array',
            'usuarios.*' => 'exists:usuarios,id'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
    
        // Actualiza los atributos
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->categoria_id = $request->categoria_id;
        $tarea->save();
    
        // Sincroniza usuarios
        if ($request->has('usuarios')) {
            $tarea->usuarios()->sync($request->usuarios);
        }
    
        return response()->json([
            'message' => 'Tarea actualizada con éxito',
            'tarea' => $tarea->load(['categoria', 'usuarios']), // Cargar relaciones actualizadas
            'status' => 200
        ]);
    }
    
}
