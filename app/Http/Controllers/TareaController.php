<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use App\Models\Usuario;
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
        $categorias = Categoria::all();
        $usuarios = Usuario::all();

        return view('tareas.create', compact('categorias','usuarios'));
    }

    public function store(Request $request){

        //dd($request->all()); // Esto detendrá la ejecución y mostrará los datos
        //logger()->info('Datos recibidos:', $request->all());

    $request->validate([
        'titulo' => 'required|string|max:100',
        'descripcion' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id',
        'usuarios' => 'required|array',
        'usuarios.*' => 'exists:usuarios,id'
    ]);

    // Crear la tarea
    $tarea = new Tarea();
    $tarea->titulo = $request->titulo;
    $tarea->descripcion = $request->descripcion;
    $tarea->categoria_id = $request->categoria_id;
    $tarea->estado_id =  1; // Estado por defecto "pendiente"
    $tarea->save();

    /* convertir esa cadena de IDs separados por comas en un array antes de hacer el attach */
    /* Esto dividirá la cadena "1,2,4" en un array [1, 2, 4] que luego será procesado correctamente por Laravel. */
    $request->merge(['usuarios' => explode(',', $request->usuarios[0])]);

    // Asignar usuarios a la tarea
    $tarea->usuarios()->attach($request->usuarios); // Verifica que $request->usuarios sea un array válido

    return redirect()->route('tarea.index')->with('success', 'Tarea guardada con éxito.');
}


    public function destroy($id){
        tarea::find($id) -> delete();
        return redirect() -> route('tarea.index');
    }

    public function edit($id){
        /*
        $tarea = tarea::find($id);
        $categorias = Categoria::find($id);
        return view('tareas.edit', compact('tarea','categorias'));
        */
        // Obtener todos las categorias de la base de datos
        $categorias = Categoria::all();
        $usuarios = Usuario::all();
        $tarea = tarea::find($id);

        return view('tareas.edit', compact('categorias','usuarios','tarea'));
    }

    public function update(Request $request){       //Post y Put necesitan recibir la informacion en un request
        $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'usuarios' => 'array',
            'usuarios.*' => 'exists:usuarios,id'
        ]);

        $tarea = tarea::findOrFail($request->id);
        //echo($tarea);
        $tarea -> tarea = $request->id;
        $tarea->save();
        return redirect()->route('tarea.index');
        return redirect()-> route('tarea.index')->with('errors', 'Error');
    }
}
