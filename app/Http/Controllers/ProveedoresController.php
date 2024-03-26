<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use App\Models\Productos;
use App\Models\ProveedorProducto;
use Illuminate\Http\Request;
use App\Rules\RutValidation;

class ProveedoresController extends Controller
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
        return view('CRUDS.proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function listado()
    {

        $proveedores = Proveedores::All();

        return view('CRUDS.proveedores.listado', compact('proveedores'));

    }
    public function store(Request $request)
    {
        $validador = Proveedores::find($request->rut);
        if ($validador == NULL) {
            $proveedor = new Proveedores();
            $proveedor->rut_proveedor = $request->rut;
            $proveedor->nombre_proveedor = $request->nombre;
            $proveedor->save();
            return redirect()->route('proveedores.edit', $request->rut)
                ->with('message', 'Se ha agregado un nuevo proveedor');
        } else {
            return redirect()->route('proveedores.create')
                ->with('danger', 'El RUT del proveedor ya existe');
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedores $proveedores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedores $proveedor)
    {
        $productos = Productos::all();
        $prod_prov = $proveedor->producto;
        return view('CRUDS.proveedores.edit', compact('proveedor', 'productos', 'prod_prov'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedores $proveedor)
    {
        $proveedor->rut_proveedor = $request->rut;
        $proveedor->nombre_proveedor = $request->nombre;
        $proveedor->save();
        return redirect()->route('proveedores.listado')
            ->with('message', 'Se ha editado un proveedor');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedores $proveedor)
    {
        $proveedor->delete();
        $proveedores = Proveedores::All();
        return redirect()->route('proveedores.listado', compact('proveedores'));
    }

    public function asignar(Request $request)
    {
        $prod_prov = new ProveedorProducto;
        $prod_prov->proveedores_rut_proveedor = $request->rut_proveedor;
        $prod_prov->productos_id_producto = $request->id_producto;
        $prod_prov->save();
        $proveedor = Proveedores::find($request->rut_proveedor);
        $prod_prov = ProveedorProducto::all();
        $productos = Productos::all();

        return view('CRUDS.proveedores.edit', compact('proveedor', 'productos', 'prod_prov'));

    }
    public function quitar(Request $request)
    {

        $prod_prov = new ProveedorProducto;
        $prod_prov->proveedores_rut_proveedor = $request->rut_proveedor;
        $prod_prov->productos_id_producto = $request->id_producto;
        $prod_prov->delete();
        $proveedor = Proveedores::find($request->rut_proveedor);
        $prod_prov = ProveedorProducto::all();
        $productos = Productos::all();

        return view('CRUDS.proveedores.edit', compact('proveedor', 'productos', 'prod_prov'));

    }
}
