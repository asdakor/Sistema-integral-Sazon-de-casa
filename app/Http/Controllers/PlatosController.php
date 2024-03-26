<?php

namespace App\Http\Controllers;

use App\Models\Platos;
use Illuminate\Http\Request;

class PlatosController extends Controller
{


    public function listar()
    {
        $platos = Platos::all();
        return view('Caja.sazon', compact('platos'));
    }
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
    public function show(Platos $platos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platos $platos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platos $platos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platos $platos)
    {
        //
    }
}
