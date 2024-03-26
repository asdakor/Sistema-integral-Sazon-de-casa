<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
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
        return view("CRUDS.roles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rol = new Roles();
        $rol->nombre_rol = $request->nombre;
        $rol->detalle_rol = $request->descripcion;
        $rol->save();
        return redirect()->route('roles.listado')->with("message","Rol agregado existosamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $rol)
    {
        return view("CRUDS.roles.edit", compact("rol"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $rol)
    {
        $rol->nombre_rol = $request->nombre;
        $rol->detalle_rol = $request->descripcion;
        $rol->save();
        return redirect()->route('roles.listado')->with("message","El rol ha sido editado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $rol)
    {
        $rol->delete();
        return redirect()->route('roles.listado')->with("danger","El rol ha sido eliminado");
    }

    public function listado(){
        $roles = Roles::all();
        return view("CRUDS.roles.listado", compact("roles"));
    }
}
