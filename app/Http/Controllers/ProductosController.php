<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
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
        return view("CRUDS.productos.create");
    }

    public function listado(){
        $productos = Productos::all();
        return view('CRUDS.productos.listado', compact('productos'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new Productos();
        $producto->nombre_producto = $request->nombre;
        $producto->precio_producto = $request->precio;
        $producto->unidad_producto = $request->unidad_producto;
        $producto->save();
        return redirect()->route('productos.listado')->with('message','Se ha agregado un producto nuevo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $producto)
    {
        return view('CRUDS.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Productos $producto)
    {
        $producto->nombre_producto = $request->nombre;
        $producto->precio_producto = $request->precio;
        $producto->unidad_producto = $request->unidad;
        $producto->save();
        return redirect()->route('productos.listado')->with('message','Se ha agregado un producto nuevo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $producto)
    {
        $producto->delete();
        return redirect()->route('productos.listado')->with('danger','Se ha eliminado un producto');
    }
}
