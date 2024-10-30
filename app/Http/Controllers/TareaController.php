<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function index(){
        $tareas = tarea::paginate(8);

        return view('tareas.index', compact('tareas'))
        ->with('i', (request()->input('page', 1) - 1)*8);
    }

    public function show($id){
        /*$tarea = tarea::find($id);        //Encontrará el ID que estaba buscando
        return view('tareas.show', compact('tarea'));*/

        $tarea = Tarea::with(['informes','usuarios'])->find($id); // Cargar la tarea y sus informes relacionados

        if (!$tarea) {
            return redirect()->route('tarea.index')->with('error', 'Tarea no encontrada.');
        }
        //dd($tarea);
        return view('tareas.show', compact('tarea'));
    }
    /*
    public function show($id){
        // Encontrar la tarea por ID
        $tarea = Tarea::find($id);
        
        // Asegúrate de que la tarea existe antes de continuar
        if (!$tarea) {
            return redirect()->route('tarea.index')->with('error', 'Tarea no encontrada.');
        }
        
        // Obtener los informes relacionados a la tarea y al técnico (usuario) en sesión actual
        $informes = Informe::whereHas('tareaTecnico', function ($query) {
            $query->where('usuario_id', auth()->user()->id); // Filtrar por el usuario en sesión
        })
        ->whereHas('tareaTecnico.tarea', function ($query) use ($id) {
            $query->where('tarea_id', $id); // Filtrar por la tarea actual
        })->get();

        // Pasar tanto la tarea como los informes a la vista
        return view('tareas.show', compact('tarea', 'informes'));
    }
*/
    public function create(){
        // Obtener todos las categorias de la base de datos
        $categorias = Categoria::all();
        $users = User::all();

        return view('tareas.create', compact('categorias','users'));
    }

    public function store(Request $request){

        //dd($request->all()); // Esto detendrá la ejecución y mostrará los datos
        //logger()->info('Datos recibidos:', $request->all());

    $request->validate([
        'titulo' => 'required|string|max:100',
        'descripcion' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id',
        'users' => 'required|array',
        'users.*' => 'exists:users,id'
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
    $request->merge(['users' => explode(',', $request->users[0])]);

    // Asignar users a la tarea
    $tarea->usuarios()->attach($request->users); // Verifica que $request->users sea un array válido

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
        $users = User::all();
        $tarea = tarea::find($id);

        return view('tareas.edit', compact('categorias','users','tarea'));
    }

    public function update(Request $request){       //Post y Put necesitan recibir la informacion en un request
        $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'users' => 'array',
            'users.*' => 'exists:users,id'
        ]);

        //buscar tarea existente
        $tarea = tarea::findOrFail($request->id);

        // Actualizar los campos correctos
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->categoria_id = $request->categoria_id;

        // Guardar la tarea actualizada
        $tarea->save();

        // Si hay users seleccionados, actualizamos la relación
        if ($request->has('users')) {
            // Dividir la cadena de users en un array, si es necesario
            $request->merge(['users' => explode(',', $request->users[0])]);

            // Sincronizar la relación muchos a muchos
            $tarea->users()->sync($request->users);
        }
        //$tarea -> tarea = $request->id;
        $tarea->save();
        return redirect()->route('tarea.index');
        return redirect()-> route('tarea.index')->with('errors', 'Error');
    }

    //Metodos personalizados para cosas especificas---------------------------------------------------

    //Metodo para autenticar usuario y mostrra solo sus tareas relacionadas
    public function misTareas()
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
    
        // Obtener solo las tareas relacionadas con el usuario autenticado
        $tareas = Tarea::whereHas('usuarios', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->with('categoria', 'estado')->get();
    
        return response()->json($tareas);
    }
    
/*
    public function loadTasks()
    {
        // Obtener el usuario autenticado usando el guard 'web' si estás utilizando sesiones y no tokens de API.
        $user = Auth::user();

        // Asegúrate de que se ha autenticado un usuario
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        // Obtener tareas relacionadas con el usuario autenticado
        $tareas = Tarea::whereHas('usuarios', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->with('categoria', 'estado')->get();

        return response()->json($tareas);
    }
*/
}
