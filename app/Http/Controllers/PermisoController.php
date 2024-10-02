<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index(){
        $permisos = Permiso::paginate(8);

        return view('permisos.index', compact('permisos'))
        ->with('i', (request()->input('page', 1) - 1)*8);
    }

    public function show($id){
        $permiso = permiso::find($id);        //Encontrará el ID que estaba buscando
        return view('permisos.show', compact('permiso'));
    }

    public function create(){
        return view('permisos.create');
    }

    public function store(Request $request){
        $request->validate([
            'tipo_permiso' => 'required|string'
        ]);

        $permiso = new permiso();
        $permiso -> tipo_permiso = $request->tipo_permiso;

        $permiso -> save();
        return redirect()-> route('permiso.index');
        return redirect()-> route('permiso.index')->with('errors', 'Error');
    }

    public function destroy($id){
        permiso::find($id) -> delete();
        return redirect() -> route('permiso.index');
    }

    public function edit($id){
        $permiso = permiso::find($id);
        return view('permisos.edit', compact('permiso'));
    }

    public function update(Request $request){       //Post y Put necesitan recibir la informacion en un request
        $request->validate([
            'tipo_permiso' => 'required|string'
        ]);

        $permiso = permiso::findOrFail($request->id);
        echo($permiso);
        $permiso -> tipo_permiso = $request->tipo_permiso;
        $permiso->save();
        return redirect()->route('permiso.index');
        return redirect()-> route('permiso.index')->with('errors', 'Error');
    }
}
