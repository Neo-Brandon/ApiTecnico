<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informe;
use Illuminate\Support\Facades\Validator;

class InformeApiController extends Controller
{
    public function index(){

        $informe = Informe::all();

        $data = [
            'message' => $informe,
            'status' => '404'
        ];
        return response()->json($data, 200);
    }

    public function getinformesByTarea($tarea_id)
    {
        // Buscar las informes que están relacionadas con la tarea especificada
        $informes = Informe::whereHas('tareaTecnico', function($query) use ($tarea_id) {
            $query->where('tarea_id', $tarea_id);
        })->get();

        // Verificar si se encontraron informes
        if($informes->isEmpty()){
            return response()->json([
                'message' => 'No se encontraron informes para la tarea especificada.',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'informes' => $informes,
            'status' => 200
        ], 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'contenido' => 'required|string',
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'image_3' => 'nullable|image',
            'tarea_tecnico_id' => 'required|exists:tarea_tecnico,id', // Valida que la asignación exista
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $informe = new Informe([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'image_path_1' => $request->image_path_1,
            'image_path_2' => $request->image_path_2,
            'image_path_3' => $request->image_path_3,
            'tarea_tecnico_id' => $request->tarea_tecnico_id
        ]);

        /* Guardado de imagenes en el path */

        if ($request->hasFile('image_1')) {
            $informe->image_path_1 = $request->file('image_1')->store('images', 'public');
        }

        if ($request->hasFile('image_2')) {
            $informe->image_path_2 = $request->file('image_2')->store('images', 'public');
        }

        if ($request->hasFile('image_3')) {
            $informe->image_path_3 = $request->file('image_3')->store('images', 'public');
        }

        if (!$informe->save()) {
            $data = [
                'message' => 'Error al crear el informe',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'informe' => $informe,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

        /*-------------------------------------------------------------------------------------*/

    public function show($id)
    {
        $informe = Informe::find($id);

        if(!$informe){
            $data = [
                'message' => 'informe no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'informe' => $informe,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $informe = Informe::find($id);

        if(!$informe){
            $data = [
                'message' => 'informe no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $informe->delete();

        $data = [
            'informe' => 'informe eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $informe = Informe::find($id);

        if(!$informe){
            $data = [
                'message' => 'informe no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'titulo' => 'required|string',
            'contenido' => 'required|string',
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'image_3' => 'nullable|image',
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

        $informe->titulo = $request->titulo;
        $informe->image_path_1 = $request->image_path_1;
        $informe->image_path_2 = $request->image_path_2;
        $informe->image_path_3 = $request->image_path_3;
        $informe ->contenido = $request->contenido;
        $informe -> save();

        $data =[
            'message' => 'informe actualizado',
            'informe' => $informe,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
