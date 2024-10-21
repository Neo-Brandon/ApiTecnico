<?php

namespace App\Http\Controllers;

use App\Models\Informe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformeController extends Controller
{
    public function index(){
        $informes = informe::paginate(8);

        return view('informe.index', compact('informes'))
        ->with('i', (request()->input('page', 1) - 1)*8);
    }

    public function show($id){
        $informe = informe::find($id);
        return view('informe.show', compact('informe'));
    }

    public function create(){

        return view('informe.create');
    }

    public function store(Request $request){

        //dd($request->all()); // Esto detendrá la ejecución y mostrará los datos
        //logger()->info('Datos recibidos:', $request->all());

    $request->validate([
        'titulo' => 'required|string',
        'contenido' => 'required|string',
        'tarea_tecnico_id' => 'required|exists:tarea_tecnico,id', // Valida que la asignación exista
        'image_1' => 'nullable|image',
        'image_2' => 'nullable|image',
        'image_3' => 'nullable|image',
    ]);

    // Crear el informe
    $informe = new informe();
    $informe->titulo = $request->titulo;
    $informe->contenido = $request->contenido;
    $informe->image_path_1 = $request->image_path_1;
    $informe->image_path_1 = $request->image_path_2;
    $informe->image_path_1 = $request->image_path_3;
    $informe->save();

    return redirect()->route('informe.index')->with('success', 'informe guardado con éxito.');
}


    public function destroy($id){
        informe::find($id) -> delete();
        return redirect() -> route('informe.index');
    }

    public function edit($id){

        $informe = informe::find($id);

        return view('informe.edit', compact('categorias','users','informe'));
    }

    public function update(Request $request){       //Post y Put necesitan recibir la informacion en un request
        $request->validate([
            'titulo' => 'required|string',
            'contenido' => 'required|string',
            'tarea_tecnico_id' => 'required|exists:tarea_tecnico,id', // Valida que la asignación exista
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'image_3' => 'nullable|image',
        ]);

        //buscar informe existente
        $informe = informe::findOrFail($request->id);

        // Actualizar los campos correctos
        $informe->titulo = $request->titulo;
        $informe->contenido = $request->contenido;
        $informe->image_path_1 = $request->image_path_1;
        $informe->image_path_1 = $request->image_path_2;
        $informe->image_path_1 = $request->image_path_3;
        

        // Guardar el informe actualizado
        $informe->save();

        //$informe -> informe = $request->id;
        $informe->save();
        return redirect()->route('informe.index');
        return redirect()-> route('informe.index')->with('errors', 'Error');
    }

    public function markAsCompleted(informe $informe)
    {
        $informe->update([
            'estado_id' => 2, // El estado "Completada" tiene el ID 2
            'completed_at' => now(),
        ]);

        return redirect()->route('informe.index')->with('success', 'informe marcada como finalizada.');
    }
}
