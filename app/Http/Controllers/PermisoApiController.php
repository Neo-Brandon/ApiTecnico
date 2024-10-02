<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermisoApiController extends Controller
{
    //
    public function index(){

        $permiso = Permiso::all();

        $data = [
            'message' => $permiso,
            'status' => '404'
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'tipo_permiso' => 'required|string'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $permiso = Permiso::create([
            'tipo_permiso' => $request->tipo_permiso
        ]);

        if(!$permiso){
            $data = [
                'message' => 'Error al crear el permiso',
                'status' => '500'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'permiso' => $permiso,
            'status' => '201'
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $permiso = Permiso::find($id);

        if(!$permiso){
            $data = [
                'message' => 'Permiso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'permiso' => $permiso,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $permiso = Permiso::find($id);

        if(!$permiso){
            $data = [
                'message' => 'Permiso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $permiso->delete();
        
        $data = [
            'permiso' => 'Permiso eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    
    }

    public function update(Request $request, $id)
    {
        $permiso = Permiso::find($id);

        if(!$permiso){
            $data = [
                'message' => 'Permiso no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'tipo_permiso' => 'required|string'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $permiso ->tipo_permiso = $request->tipo_permiso;
        $permiso -> save();

        $data =[
            'message' => 'Permiso actualizado',
            'permiso' => $permiso,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
