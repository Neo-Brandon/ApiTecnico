<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index(){
        $tareas = tarea::paginate(8);

        return view('tareas.index', compact('tareas'))
        ->with('i', (request()->input('page', 1) - 1)*8);
    }

    public function show($id){
        $tarea = tarea::find($id);        //Encontrará el ID que estaba buscando
        return view('tareas.show', compact('tarea'));
    }

    public function create(){
        // Obtener todos las categorias de la base de datos
        $categoria = Categoria::all();

        return view('tareas.create', compact('tareas'));
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|unique:tareas,nombre',
            'correo' => 'required|string|unique:tareas,correo',
            'pass' => 'required|string',
            'permiso_id' => 'required|exists:permisos,id' // Validar que el permiso existe
        ]);

        $tarea = new tarea();
        $tarea -> nombre = $request->nombre;
        $tarea -> correo = $request->correo;
        $tarea->pass = bcrypt($request->pass); // Encriptar y asignar la contraseña

        $tarea -> save();

         // Asignar permisos al tarea (usando el método attach)
         $tarea->permisos()->attach($request->permiso_id); // Aquí debes usar $request->permiso_id

        return redirect()-> route('tarea.index');
        return redirect()-> route('tarea.index')->with('errors', 'Error');
    }

    public function destroy($id){
        tarea::find($id) -> delete();
        return redirect() -> route('tarea.index');
    }

    public function edit($id){
        $tarea = tarea::find($id);
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request){       //Post y Put necesitan recibir la informacion en un request
        $request->validate([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            //'pass' => $request->pass,
            'pass' => bcrypt($request->pass), // Asegúrate de encriptar la contraseña
        ]);

        $tarea = tarea::findOrFail($request->id);
        echo($tarea);
        $tarea -> tarea = $request->tarea;
        $tarea->save();
        return redirect()->route('tarea.index');
        return redirect()-> route('tarea.index')->with('errors', 'Error');
    }
}
