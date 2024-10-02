<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioApiController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index(){

        $usuario = Usuario::all();
       /*
        if($usuario->isEmpty()){
            $data = [
                'message' => 'No se encontraron usuarios',
                'status' => '404'
            ];
            return response()->json($data, 200);
        }
        */

        $data = [
            'message' => $usuario,
            'status' => '404'
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|unique:usuarios,nombre',
            'correo' => 'required|string|unique:usuarios,correo',
            'pass' => 'required|string',
            'permiso_id' => 'required|exists:permisos,id' // Validar que el permiso existe
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            //'pass' => $request->pass,
            'pass' => bcrypt($request->pass), // Asegúrate de encriptar la contraseña
        ]);

        // Asignar permisos al usuario (usando el método attach)
        $usuario->permisos()->attach($request->permiso_id); // Aquí debes usar $request->permiso_id

        if(!$usuario){
            $data = [
                'message' => 'Error al crear el usuario',
                'status' => '500'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'usuario' => $usuario,
            'status' => '201'
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $usuario->delete();
        
        $data = [
            'usuario' => 'usuario eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'nombre' => 'required|string|unique:usuarios,nombre',
            'correo' => 'required|string|unique:usuarios,correo',
            'pass' => 'required|string',
            'permiso_id' => 'required|exists:permisos,id' // Validar que el permiso existe
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario ->nombre = $request->nombre;
        $usuario ->correo = $request->correo;
        $usuario ->pass = $request->pass;
        $usuario -> save();

        $data =[
            'message' => 'usuario actualizado',
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
