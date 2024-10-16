<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotaApiController extends Controller
{
    public function index(){

        $nota = Nota::all();

        $data = [
            'message' => $nota,
            'status' => '404'
        ];
        return response()->json($data, 200);
    }

    public function getNotasByTarea($tarea_id)
    {
        // Buscar las notas que están relacionadas con la tarea especificada
        $notas = Nota::whereHas('tareaTecnico', function($query) use ($tarea_id) {
            $query->where('tarea_id', $tarea_id); // Filtrar por el ID de la tarea
        })->get();

        // Verificar si se encontraron notas
        if($notas->isEmpty()){
            return response()->json([
                'message' => 'No se encontraron notas para la tarea especificada.',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'notas' => $notas,
            'status' => 200
        ], 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contenido' => 'required|string',
            'tarea_tecnico_id' => 'required|exists:tarea_tecnico,id', // Valida que la asignación exista
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'image_3' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $nota = new Nota([
            'contenido' => $request->contenido,
            'tarea_tecnico_id' => $request->tarea_tecnico_id // Asegúrate de capturar el ID de tarea_tecnico
        ]);

        /* Guardado de imagenes en el path */

        if ($request->hasFile('image_1')) {
            $nota->image_path_1 = $request->file('image_1')->store('images');
        }

        if ($request->hasFile('image_2')) {
            $nota->image_path_2 = $request->file('image_2')->store('images');
        }

        if ($request->hasFile('image_3')) {
            $nota->image_path_3 = $request->file('image_3')->store('images');
        }

        if (!$nota->save()) {
            $data = [
                'message' => 'Error al crear la nota',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'nota' => $nota,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

        /*-------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------------------------

    public function show($id)
    {
        $nota = Nota::find($id);

        if(!$nota){
            $data = [
                'message' => 'nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'nota' => $nota,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $nota = Nota::find($id);

        if(!$nota){
            $data = [
                'message' => 'nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $nota->delete();
        
        $data = [
            'nota' => 'nota eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    
    }

    public function update(Request $request, $id)
    {
        $nota = Nota::find($id);

        if(!$nota){
            $data = [
                'message' => 'nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'contenido' => 'required|string',
            'tarea_tecnico_id' => 'required|exists:tarea_tecnico,id' // Valida que la asignación exista
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $nota ->contenido = $request->contenido;
        $nota -> save();

        $data =[
            'message' => 'nota actualizada',
            'nota' => $nota,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
