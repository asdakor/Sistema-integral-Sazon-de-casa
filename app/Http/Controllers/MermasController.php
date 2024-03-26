<?php

namespace App\Http\Controllers;

use App\Models\Mermas;
use App\Models\Productos;
use Illuminate\Http\Request;

class MermasController extends Controller
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
        $productos = Productos::all();
        
        return view("Admin.ingresarmerma", compact("productos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $merma = new Mermas();
        $merma->id_producto = $request->producto;
        $merma->fecha = date("Y-m-d");
        $merma->cantidad_producto = $request->cantidad;
        $merma->glosa = $request->glosa;
        $producto = Productos::find($request->producto);

        $producto->stock = ($producto->stock)-($request->cantidad);
        $producto->save();
        $merma->save();
        return redirect()->route("mermas.create")->with("message","Merma ingresada correctamente");
    }

    public function ajustar()
    {
        $productos = Productos::all();
        return view("Admin.ajustestock", compact("productos"));
    }

    public function guardarajuste(Productos $producto, Request $request)
    {
        $producto->stock_critico = $request->stockcritico;
        $producto->save();
        return redirect()->route("ajustes.stock");
    }
    /**
     * Display the specified resource.
     */
    public function show(Mermas $mermas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mermas $mermas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mermas $mermas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mermas $mermas)
    {
        //
    }
}
