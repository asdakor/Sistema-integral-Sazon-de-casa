<?php

namespace App\Http\Controllers;

use App\Models\DetallesBoletas;
use Illuminate\Http\Request;

class DetallesBoletasController extends Controller
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
        //
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
    public function show(DetallesBoletas $detallesBoletas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetallesBoletas $detallesBoletas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetallesBoletas $detallesBoletas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetallesBoletas $detallesBoletas, Request $request)
    {
               
        $id_boleta = $detallesBoletas->id_boleta;
        $detallesBoletas->delete();

        return redirect()->route('test2', $id_boleta);
    }
}
