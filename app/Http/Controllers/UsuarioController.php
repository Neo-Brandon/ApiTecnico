<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permiso; // Importar el modelo Permiso
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UsuarioController extends Controller
{
    public function index(){
        $usuarios = User::paginate(8);

        return view('usuarios.index', compact('usuarios'))
        ->with('i', (request()->input('page', 1) - 1)*8);
    }

    public function show($id){
        $usuario = User::find($id);        //Encontrará el ID que estaba buscando
        return view('usuarios.show', compact('usuario'));
    }

    public function create(){
        // Obtener todos los permisos de la base de datos
        $permisos = Permiso::all();

        $roles = Role::all();
        return view('usuarios.create', compact('roles'));


        //return view('usuarios.create', compact('permisos'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|string|unique:users,email',
            'password' => 'required|string',
            'role' => 'required|exists:roles,name',
            //'permiso_id' => 'required|exists:permisos,id' // Validar que el permiso existe
        ],[
            'email.required' => 'El campo correo es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
        ]);

        $usuario = new User();
        $usuario -> name = $request->name;
        $usuario -> email = $request->email;
        $usuario->password = bcrypt($request->password); // Encriptar y asignar la contraseña

        $usuario -> save();

         // Asignar permisos al usuario (usando el método attach)
         //$usuario->permisos()->attach($request->permiso_id); // Aquí debes usar $request->permiso_id
         $usuario->assignRole($request->role_id);

        return redirect()-> route('usuario.index');
        return redirect()-> route('usuario.index')->with('errors', 'Error');
    }

    public function destroy($id){
        User::find($id) -> delete();
        return redirect() -> route('usuario.index');
    }

    public function edit($id){
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request){       
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'nullable|string', // Hacer la contraseña opcional si no se va a cambiar
        ]);
    
        $usuario = User::findOrFail($request->id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
    
        // Si hay una nueva contraseña, la actualizamos
        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }
    
        $usuario->save();
        return redirect()->route('usuario.index');
    }
    
}
