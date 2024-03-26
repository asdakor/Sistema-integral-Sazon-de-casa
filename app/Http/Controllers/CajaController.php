<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajadores;
use App\Models\Cajeros;
use App\Models\Categorias;
use App\Models\ProductosFinales;
use App\Models\Boletas;
use App\Models\DetallesBoletas;
use App\Models\Recetas;
use App\Models\Productos;
use PDF;
use Illuminate\Support\Facades\Date;

use function PHPUnit\Framework\returnValueMap;

class CajaController extends Controller
{
    public function iniciocaja()
    {

        return view('Caja.iniciar');
    }
    public function validarcajero(Request $request)
    {
        $validador = Trabajadores::all();

        foreach ($validador as $validado) {
            if (($validado->rut_trabajador) == ($request->rut_trabajador)) {
                $cajero = Cajeros::find($request->rut_trabajador);
                if (($cajero->clave_cajero) == ($request->clave_cajero)) {
                    return redirect()->route('sazon.caja');
                } else {
                    return redirect()->route('caja.inicio');
                }
            } elseif (($request->rut_trabajador) == Null) {
                return redirect()->route('caja.inicio');
            }
        }
        return redirect()->route('caja.inicio');
    }

    public function actualizarlista(Request $request)
    {

        $categorias = Categorias::all();
        $productosfinales = ProductosFinales::all()->where('id_categoria', '=', $request->opcion);

        return view('Caja.sazon', compact('categorias', 'productosfinales'));

    }

    public function cajasazon()
    {
        $categorias = Categorias::all();
        $productosfinales = ProductosFinales::all()->where('id_categoria', '=', 1);
        return view('Caja.sazon', compact('categorias', 'productosfinales'));
    }
    
    
    public function test(Request $request)
    {
        $productofinal = ProductosFinales::find($request->producto);
        $boleta = new Boletas();
        $detalleboleta = new DetallesBoletas();
        $boleta->fecha = date("Y-m-d");
        $detalleboleta->id_producto = $productofinal->id_productofinal;
        $detalleboleta->nombre_producto = $productofinal->nombre_producto;
        $detalleboleta->cantidad_detalle = 1;
        $detalleboleta->precio_detalle = ($productofinal->precio_producto) * ($detalleboleta->cantidad_detalle);
        $boleta->save();
        $detalleboleta->id_boleta = $boleta->id_boleta;
        $detalleboleta->save();

        return redirect()->route('test2', $boleta->id_boleta);

    }

    public function test2(Boletas $boleta)
    {
        $categorias = Categorias::all();
        $productosfinales = ProductosFinales::all()->where('id_categoria', '=', 1);
        $detalles = DetallesBoletas::all()->where('id_boleta', '=', $boleta->id_boleta);
        $totalboleta = 0;
        return view('Caja.boletaactual', compact('productosfinales', 'categorias', 'boleta', 'detalles', 'totalboleta'));
    }

    public function actualizarlista2(Request $request, Boletas $boleta)
    {
        $categorias = Categorias::all();
        $productosfinales = ProductosFinales::all()->where('id_categoria', '=', $request->opcion);
        $detalles = DetallesBoletas::all()->where('id_boleta', '=', $boleta->id_boleta);
        $totalboleta = 0;
        return view('Caja.boletaactual', compact('productosfinales', 'categorias', 'boleta', 'detalles', 'totalboleta'));

    }
    public function agregardetalle(Request $request, Boletas $boleta)
    {

        $productofinal = ProductosFinales::find($request->producto);
        $detalleboleta = new DetallesBoletas();
        $detalleboleta->id_producto = $productofinal->id_productofinal;
        $detalleboleta->nombre_producto = $productofinal->nombre_producto;
        $detalleboleta->cantidad_detalle = 1;
        $detalleboleta->precio_detalle = ($productofinal->precio_producto) * ($detalleboleta->cantidad_detalle);
        $detalleboleta->id_boleta = $boleta->id_boleta;
        $detalleboleta->save();
        return redirect()->route('test2', $boleta->id_boleta);

    }
    public function generar(Request $request, Boletas $boleta)
    {
        $totaliva = (($request->total_boleta) * 0.19);
        $totalneto = ($request->total_boleta) - ($totaliva);
        $boleta->total_iva = $totaliva;
        $boleta->total_neto = $totalneto;
        $boleta->total_boleta = $request->total_boleta;
        $boleta->save();
        
        $detalles = DetallesBoletas::all()->where('id_boleta','=',$boleta->id_boleta);
        foreach ($detalles as $detalle) {
            $receta = Recetas::all()->where('id_productofinal','=',$detalle->id_producto);
            foreach($receta as $item){
                $producto = Productos::find($item->id_producto);
                $producto->stock = ($producto->stock) - ($item->cantidad_receta);
                $producto->save();
            }
        }

        $boleta = Boletas::find($boleta->id_boleta);
        return redirect()->route('sazon.caja');

    }


    public function boletapdf(Boletas $boleta)
    {
        $detalles = DetallesBoletas::all();
        $boleta = Boletas::find($boleta->id_boleta);
        return view('Caja.imprimir', compact('boleta', 'detalles'));
    }
}
