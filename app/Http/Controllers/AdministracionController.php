<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Productos;
use Illuminate\Http\Request;
use App\Models\Control;
class AdministracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Productos::all();
        $productosSinStock = [];

        foreach ($productos as $producto) {
            if ($producto->stock < $producto->stock_critico) {
                $productosSinStock[] = $producto;
            }
        }

        return view("admindashboard", compact('productosSinStock'));
    }
    public function fecha()
    {
        $productos = Productos::all();
        return view("Admin.fechacontrol", compact("productos"));
    }
    public function revisarfecha()
    {
        $productos = Productos::all();
        return view("Admin.fecharevision", compact("productos"));
    }

    public function ingresarcontrol(Request $request)
    {
        $fecha = $request->fecha;
        $productos = Productos::all();
        foreach ($productos as $producto){
            $control = Control::where('id_producto', $producto->id_producto)
            ->where('fecha', $request->fecha)
            ->first();
            if ($control == null){
                $nuevo = new Control();
                $nuevo->id_producto = $producto->id_producto;
                $nuevo->nombre_producto = $producto->nombre_producto;
                $nuevo->cantidad_contada = 0;
                $nuevo->fecha = $fecha;
                $nuevo->save();
            }
        }
        $listado = Control::all()->where('fecha','=',$fecha);
        
        return view("Admin.controlexistencias", compact("productos", 'fecha','control', 'listado'));
    }
    public function listadoporfecha(Request $request)
    {
        $fecha = $request->fecha;
        $productos = Productos::all();
        $control = Control::all()->where('fecha','=',$fecha);
        return view("Admin.revision", compact("productos", 'fecha','control'));
    }
    public function guardar(Productos $producto, Request $request){
        $fecha = $request->fecha;
        $control = Control::where('id_producto', $producto->id_producto)
                    ->where('fecha', $request->fecha)
                    ->first();
        if($control==null){
            $nuevo = new Control;
            $nuevo->id_producto = $producto->id_producto;
            $nuevo->cantidad_contada = $request->cantidad;
            $nuevo->fecha = $request->fecha;
            $nuevo->save();
            return redirect()->route('administracion.control', compact('fecha'));
        } else {
            $control->cantidad_contada = $request->cantidad;
            $control->save();
            return redirect()->route('administracion.control', compact('fecha'));
        }
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
