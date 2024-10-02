<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Permiso; // Importar el modelo Permiso
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = usuario::paginate(8);

        return view('usuarios.index', compact('usuarios'))
        ->with('i', (request()->input('page', 1) - 1)*8);
    }

    public function show($id){
        $usuario = Usuario::find($id);        //Encontrará el ID que estaba buscando
        return view('usuarios.show', compact('usuario'));
    }

    public function create(){
        // Obtener todos los permisos de la base de datos
        $permisos = Permiso::all();

        return view('usuarios.create', compact('permisos'));
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|unique:usuarios,nombre',
            'correo' => 'required|string|unique:usuarios,correo',
            'pass' => 'required|string',
            'permiso_id' => 'required|exists:permisos,id' // Validar que el permiso existe
        ]);

        $usuario = new usuario();
        $usuario -> nombre = $request->nombre;
        $usuario -> correo = $request->correo;
        $usuario->pass = bcrypt($request->pass); // Encriptar y asignar la contraseña

        $usuario -> save();

         // Asignar permisos al usuario (usando el método attach)
         $usuario->permisos()->attach($request->permiso_id); // Aquí debes usar $request->permiso_id

        return redirect()-> route('usuario.index');
        return redirect()-> route('usuario.index')->with('errors', 'Error');
    }

    public function destroy($id){
        usuario::find($id) -> delete();
        return redirect() -> route('usuario.index');
    }

    public function edit($id){
        $usuario = usuario::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request){       //Post y Put necesitan recibir la informacion en un request
        $request->validate([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            //'pass' => $request->pass,
            'pass' => bcrypt($request->pass), // Asegúrate de encriptar la contraseña
        ]);

        $usuario = usuario::findOrFail($request->id);
        echo($usuario);
        $usuario -> usuario = $request->usuario;
        $usuario->save();
        return redirect()->route('usuario.index');
        return redirect()-> route('usuario.index')->with('errors', 'Error');
    }
}
