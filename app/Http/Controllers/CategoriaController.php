<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::paginate(8);

        return view('categorias.index', compact('categorias'))
        ->with('i', (request()->input('page', 1) - 1)*8);
    }

    public function show($id){
        $categoria = Categoria::find($id);        //Encontrará el ID que estaba buscando
        return view('categorias.show', compact('categoria'));
    }

    public function create(){
        return view('categorias.create');
    }

    public function store(Request $request){
        $request->validate([
            'categoria' => 'required|string'
        ]);

        $categoria = new categoria();
        $categoria -> categoria = $request->categoria;

        $categoria -> save();
        return redirect()-> route('categoria.index');
        return redirect()-> route('categoria.index')->with('errors', 'Error');
    }

    public function destroy($id){
        categoria::find($id) -> delete();
        return redirect() -> route('categoria.index');
    }

    public function edit($id){
        $categoria = categoria::find($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request){       //Post y Put necesitan recibir la informacion en un request
        $request->validate([
            'categoria' => 'required|string'
        ]);

        $categoria = categoria::findOrFail($request->id);
        echo($categoria);
        $categoria -> categoria = $request->categoria;
        $categoria->save();
        return redirect()->route('categoria.index');
        return redirect()-> route('categoria.index')->with('errors', 'Error');
    }
}
