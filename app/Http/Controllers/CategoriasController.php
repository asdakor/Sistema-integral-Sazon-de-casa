<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function listado()
    {
        $categorias = Categorias::All();
        return view('CRUDS.categorias.listado', compact('categorias'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CRUDS.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->nombre == null){
            return redirect()->route('categorias.create')->with('danger','no puede enviar el nombre vacio');
        }
        $caregoria = new Categorias();
        $caregoria->nombre_categoria = $request->nombre;
        $caregoria->save();
        return redirect()->route('categorias.listado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorias $categoria)
    {
        return view('CRUDS.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorias $categoria)
    {
        $categoria->nombre_categoria = $request->nombre;
        $categoria->save();
        return redirect()->route('categorias.listado')->with('message','Categoria actualizada con exito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorias $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.listado');
    }
}
