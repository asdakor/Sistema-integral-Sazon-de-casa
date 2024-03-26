<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\ProductosFinales;
use Illuminate\Http\Request;

class ProductosFinalesController extends Controller
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
        $categorias = Categorias::all();
        return view("CRUDS.productosfinales.create", compact("categorias"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productofinal = new ProductosFinales();
        $productofinal->nombre_producto = $request->nombre;
        $productofinal->precio_producto = $request->precio;
        $productofinal->id_categoria    = $request->categoria;
        $productofinal->save();
        return redirect()->route("productosfinales.listado")->with("message","Se a agregado el producto exitosamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductosFinales $productosFinales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductosFinales $productofinal)
    {
        $categorias = Categorias::all();
        return view("CRUDS.productosfinales.edit", compact("productofinal", "categorias"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductosFinales $productofinal)
    {
        $productofinal->nombre_producto = $request->nombre;
        $productofinal->precio_producto = $request->precio;
        $productofinal->id_categoria    = $request->categoria;
        $productofinal->save();
        return redirect()->route("productosfinales.listado")->with("message","Se a modificado el producto exitosamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductosFinales $productofinal)
    {
        $productofinal->delete();
        return redirect()->route("productosfinales.listado")->with("danger","Se ha eliminado un producto");
    }
    public function listado()
    {
        $categorias = Categorias::all();
        $productosfinales = ProductosFinales::all();
        return view("CRUDS.productosfinales.listado", compact("productosfinales", "categorias"));
    }
    
}
