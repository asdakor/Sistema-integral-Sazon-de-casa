@extends('layouts.admin')

@section('main')
    <div class="card-deck">
        <div class="card" style="width: 50rem;">

            <form method="POST" action="{{ route('facturas.guardar') }}">
                @csrf
                @method('POST')

                <div class="card-body">
                    <div class="form-group">
                        <label for="numero_factura">Nº Factura:
                            <input class="form-control" id="numero_factura" type="text" name="numero_factura"
                                value="{{ old('numero_factura') }}">
                            @error('numero_factura')
                                <small> {{ $message }}</small>
                            @enderror
                        </label>

                        <label for="fecha">Fecha:
                            <input class="form-control" id="fecha" type="date" name="fecha"> </label>
                        <label for="proveedor">Proveedores:
                            <select class="form-control "name="proveedor" id="proveedor">
                                @foreach ($proveedores as $proveedor)                               
                                    <option value="{{ $proveedor->rut_proveedor }}">{{ $proveedor->rut_proveedor }} {{ $proveedor->nombre_proveedor }}</option>
                                @endforeach
                            </select></label> <br>
                        <label for="tipo">Producto:
                            <select class="form-control "name="producto" id="producto">
                                @foreach ($productos as $producto)
                                  
                                    <option value="{{ $producto->id_producto}}"> {{$producto->nombre_producto}}</option>
                                @endforeach
                            </select></label>
                        <label for="cantidad">Cantidad:
                            <input type="text" id="cantidad" name="cantidad" class="form-control"></label>
                        <label for="precio">Precio:
                            <input type="text" id="precio" name="precio" class="form-control"></label> <br>
                        <label for="totalneto">Total Neto:
                            <input class="form-control" id="totalneto" type="text" name="totalneto"> </label>
                        <label for="totaliva">Total Iva:
                            <input class="form-control" id="totaliva" type="text" name="totaliva"> </label>
                        <label for="totalfactura">Total Factura:
                            <input class="form-control" id="totalfactura" type="text" name="totalfactura"> </label> <br>
                        <br> <button type="submit" class="btn btn-success">Continuar</button>
                    </div>
                </div>

        </div>
        <div class="card" style="width: 50rem; ml-3">
            <table class="table tablebordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->cantidad_detalle}}</td>
                        
                        <td>
                            @foreach ($productos as $producto)
                                @if (($detalle->id_producto) == ($producto->id_producto))
                                    {{$producto}}
                                @endif
                            @endforeach 
                        </td>
                        <td>{{ $detalle->precio_detalle}}</td>
                        <td>
                            <a href="#" class="btn btn-info">Continuar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-group">
        <div class="card" style="width: 50rem;">
            aaaaaaaaaaaaaaaaaa2
        </div>
    </div>
@endsection
