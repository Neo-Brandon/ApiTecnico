<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioApiController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index(){

        $usuario = User::all();

        $data = [
            'message' => $usuario,
            'status' => '404'
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|string|unique:users,email',
            'password' => 'required|string',
            'permiso_id' => 'required|exists:permisos,id' // Validar que el permiso existe
        ],[
            'email.required' => 'El campo correo es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            //'pass' => $request->pass,
            'password' => bcrypt($request->pass), // Asegúrate de encriptar la contraseña
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
            'user' => $usuario,
            'status' => '201'
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $usuario = User::find($id);

        if(!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'user' => $usuario,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $usuario = User::find($id);

        if(!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $usuario->delete();
        
        $data = [
            'user' => 'usuario eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);

        if(!$usuario){
            $data = [
                'message' => 'usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
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

        $usuario ->name = $request->name;
        $usuario ->email = $request->email;
        $usuario ->password = $request->password;
        $usuario -> save();

        $data =[
            'message' => 'usuario actualizado',
            'user' => $usuario,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
