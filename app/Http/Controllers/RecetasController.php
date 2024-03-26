<?php

namespace App\Http\Controllers;

use App\Models\Platos;
use App\Models\Productos;
use App\Models\ProductosFinales;
use App\Models\Recetas;
use Illuminate\Http\Request;

class RecetasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $platos = ProductosFinales::all();
        return view("CRUDS.recetas.create", compact("platos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Recetas $recetas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recetas $recetas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recetas $recetas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recetas $receta)
    {
        $productofinal = ProductosFinales::find($receta->id_productofinal);
        $productos = Productos::all();
        $recetas = Recetas::all();
        $receta->delete();
       
        return redirect()->route("recetas.editarreceta", $productofinal->id_productofinal);
    }
    public function ingresar(Request $request)
    {
        $receta = Recetas::all()->where('id_productofinal','=',$request->productofinal);
        //EDITAR PLATOS POR PRODUCTOSFINALES CUANDO ESTE LISTA LA BD
        $productofinal = ProductosFinales::find($request->productofinal);
        $productos = Productos::all();
        if ($receta == null) {
            return view("CRUDS.recetas.crearreceta", compact('productofinal', 'productos'))
            ->with('message', 'No existe una receta para este , porfavor ingrese un producto para crearla');
        } else {
            return redirect()->route("recetas.editarreceta", $productofinal->id_productofinal);
        }
    }

    public function editarreceta(ProductosFinales $productofinal)
    {
        $recetas = Recetas::all()->where('id_productofinal','=',$productofinal->id_productofinal);
        
        $productos = Productos::all();
        return view("CRUDS.recetas.editar", compact("productos",'productofinal', 'recetas'));
    }

    public function crearreceta()
    {

        $productos = Productos::all();
        return view("CRUDS.recetas.editar", compact("productos"));
    }

    public function agregar(Request $request){
        $receta = new Recetas();
        $receta->id_productofinal = $request->productofinal;
        $receta->id_producto = $request->producto;
        $receta->cantidad_receta = $request->cantidad;
        $receta->save();
        return redirect()->route("recetas.editarreceta", $request->productofinal);
    }

}
