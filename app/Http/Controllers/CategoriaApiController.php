<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */public function index(){

        $categoria = Categoria::all();
       /*
        if($categoria->isEmpty()){
            $data = [
                'message' => 'No se encontraron categorias',
                'status' => '404'
            ];
            return response()->json($data, 200);
        }
        */

        $data = [
            'message' => $categoria,
            'status' => '404'
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'categoria' => 'required|string'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $categoria = Categoria::create([
            'categoria' => $request->categoria
        ]);

        if(!$categoria){
            $data = [
                'message' => 'Error al crear el categoria',
                'status' => '500'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'categoria' => $categoria,
            'status' => '201'
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);

        if(!$categoria){
            $data = [
                'message' => 'categoria no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'categoria' => $categoria,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if(!$categoria){
            $data = [
                'message' => 'categoria no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $categoria->delete();
        
        $data = [
            'categoria' => 'categoria eliminada',
            'status' => 200
        ];
        return response()->json($data, 200);
    
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if(!$categoria){
            $data = [
                'message' => 'categoria no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'categoria' => 'required|string'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $categoria ->categoria = $request->categoria;
        $categoria -> save();

        $data =[
            'message' => 'categoria actualizado',
            'categoria' => $categoria,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
