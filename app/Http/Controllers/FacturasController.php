<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresoRequest;
use App\Models\Facturas;
use App\Models\Detalles;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\ProveedorProducto;
use Illuminate\Http\Request;


class FacturasController extends Controller
{


    public function ingresar()
    {

        $proveedores = Proveedores::all();
        $productos = Productos::all();
        $prod_prov = ProveedorProducto::all();
        $detalles = Detalles::all();
        return view('Facturas.ingresar', compact('productos', 'prod_prov', 'proveedores', 'detalles'));
    }


    public function guardar(Request $request)
    {

        $request->validate([
            'numero_factura' => ['required', 'integer'],
            'fecha' => ['required'],
            'precio' => ['required', 'min:1', 'integer'],
            'cantidad' => ['required', 'min:1', 'integer'],
            'totalneto' => ['required', 'min:1', 'integer'],
            'totaliva' => ['required', 'min:1', 'integer'],
            'totalfactura' => ['required', 'min:1', 'integer'],
        ]);

        $existe = Facturas::find($request->numero_factura);
        if ($existe == null) {
            $productos = Productos::find($request->producto);
            $productos->stock = (($productos->stock) + ($request->cantidad));
            $factura = new Facturas();
            $detalle = new Detalles();
            $factura->numero_factura = $request->numero_factura;
            $factura->rut_proveedor = $request->proveedor;
            $factura->fecha = $request->fecha;
            $factura->total_neto = $request->totalneto;
            $factura->total_iva = $request->totaliva;
            $factura->total_factura = $request->totalfactura;
            $detalle->numero_factura = $request->numero_factura;
            $detalle->id_producto = $request->producto;
            $detalle->cantidad_detalle = $request->cantidad;
            $detalle->precio_detalle = $request->precio;
            $factura->save();
            $detalle->save();
            $productos->save();
            return redirect()->route('facturas.existente', $request->numero_factura)->with('success', 'se ha agregado la factura exitosamente');
        } else {
            return redirect()->route('facturas.ingresar')->with('danger', 'El numero de factura ingresado ya existe');
        }

    }

    public function existente(Facturas $factura)
    {
        $productos = Productos::all();        
        $detalles = Detalles::all()->where('numero_factura', '=', $factura->numero_factura);
        $sumatoria = 0;
        foreach ($detalles as $detalle) {
            $sumatoria += $detalle->precio_detalle;
        };
       
        return view('Facturas.existente', compact('productos', 'detalles','factura', 'sumatoria'));
    }




    public function guardaren(Request $request)
    {
        $request->validate([
            'numero_factura' => ['required', 'integer'],
            'fecha' => ['required'],
            'precio' => ['required', 'min:1', 'integer'],
            'cantidad' => ['required', 'min:1', 'integer'],
            'totalneto' => ['required', 'min:1', 'integer'],
            'totaliva' => ['required', 'min:1', 'integer'],
            'totalfactura' => ['required', 'min:1', 'integer'],
        ]);

        $productos = Productos::find($request->producto);
        $productos->stock = (($productos->stock) + ($request->cantidad));

        $detalle = new Detalles();
        $detalle->numero_factura = $request->numero_factura;
        $detalle->id_producto = $request->producto;
        $detalle->cantidad_detalle = $request->cantidad;
        $detalle->precio_detalle = $request->precio;
        $productos->save();
        $detalle->save();
        return redirect()->route('facturas.existente', $request->numero_factura)->with('success', 'se ha agregado la factura exitosamente');


    }
    /**
     * Display the specified resource.
     *
     * @param  \App\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */

     public function buscar()
     {
        
         return view('Facturas.buscar');
     }

     public function buscarfecha()
     {
        
         return view('Facturas.buscarporfecha');
     }
     public function listadoporfecha(Request $request)
     {
        $facturas = Facturas::all()->whereBetween('fecha', [$request->fechainicio, $request->fechafinal]);
        
        return view('Facturas.listadoporfecha', compact('facturas'));
     }


     public function eliminar(Facturas $factura)
     {
        $detalles = Detalles::all()->where('numero_factura','=', $factura->numero_factura);
        foreach ($detalles as $detalle) {
            $producto = Productos::find($detalle->id_producto);
            $producto->stock = ($producto->stock) - ($detalle->cantidad_detalle);
            $producto->save();
            $detalle->delete();
        }
        $factura->delete();
        return redirect()->route('facturas.buscar')->with('success','se ha eliminado la factura exitosamente');
         
     }
     public function buscarfactura(Request $request)
     {
        $factura = Facturas::find($request->numero_factura);
        if($factura == null){
            return redirect()->route('facturas.buscar')->with('danger','el numero de factura ingresado no existe');
        } else {
            return redirect()->route('facturas.existente', $request->numero_factura);
        }
         
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
    public function show(Facturas $facturas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facturas $facturas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facturas $facturas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facturas $facturas)
    {
        //
    }
}