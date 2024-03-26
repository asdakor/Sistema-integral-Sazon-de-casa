<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use App\Models\Detalles;
use App\Models\Proveedores;
use App\Models\Facturas;

class DetallesController extends Controller
{
    public function destroy(Detalles $detalles, Request $request)
    {
        $factura = $detalles->numero_factura;
        $producto = Productos::find($detalles->id_producto);
            $producto->stock = ($producto->stock) - ($detalles->cantidad_detalle);
            $producto->save();
        $detalles->delete();
        return redirect()->route('facturas.existente', $factura)->with('success', 'se ha agregado la factura exitosamente');
        }
    }
