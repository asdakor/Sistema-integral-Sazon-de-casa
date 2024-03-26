@extends('layouts.admin')

@section('main')
    <div class="card-deck" style="width: 50rem;">
        <div class="card" style="width: 50rem;" x-data="validar()">

            <form id="formulariofactura" method="POST" action="{{ route('facturas.guardar') }}">
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
                            <input class="form-control" id="fecha" type="date" name="fecha">
                            @error('fecha')
                                <small> {{ $message }}</small>
                            @enderror </label> </label>
                        <label for="proveedor">Proveedores:
                            <select class="form-control "name="proveedor" id="proveedor">
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->rut_proveedor }}">{{ $proveedor->rut_proveedor }}
                                        {{ $proveedor->nombre_proveedor }}</option>
                                @endforeach
                            </select></label> <br>
                        <label for="tipo">Producto:
                            <select class="form-control "name="producto" id="producto">
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id_producto }}"> {{ $producto->nombre_producto }}</option>
                                @endforeach
                            </select></label>
                        <label for="cantidad">Cantidad:
                            <input type="number" id="cantidad" name="cantidad" class="form-control">
                            @error('cantidad')
                                <small> {{ $message }}</small>
                            @enderror </label></label>
                        <label for="precio">Precio:
                            <input x-model="precio" type="text" id="precio" name="precio" class="form-control">
                            @error('precio')
                                <small style="color: red">El precio no puede ser 0</small>
                            @enderror <br></label> <br>

                        <label for="totalneto">Total Neto:
                            <input x-model="totalneto" class="form-control" id="totalneto" type="text" name="totalneto">
                            @error('totalneto')
                                <small> {{ $message }}</small>
                            @enderror </label> </label>
                        <label for="totaliva">Total Iva:
                            <input x-model="totaliva" class="form-control" id="totaliva" type="text" name="totaliva">
                            @error('totaliva')
                                <small> {{ $message }}</small>
                            @enderror </label> </label>
                        <label for="totalfactura">Total Factura:
                            <input x-model="totalfactura" class="form-control" id="totalfactura" type="text" name="totalfactura">
                            @error('totalfactura')
                                <small> {{ $message }}</small>
                            @enderror </label> </label> <br>
                        <br>

                        <button type="button" class="btn btn-success" @click="calcular()">Continuar</button>


                    </div>
                </div>

        </div>

    </div>

    <script>
        function validar() {
            return {
                totalneto: null,
                totaliva: null,
                totalfactura: null,
                precio: null,
                continuar: true,
                calcular() {
                    let totalnetoNum = parseFloat(this.totalneto);
                    let totalivaNum = parseFloat(this.totaliva);
                    let totalfacturaNum = parseFloat(this.totalfactura);
                    let precioNum = parseFloat(this.precio);
                    let diferencia = totalfacturaNum - (totalivaNum + totalnetoNum);
                    if(precioNum > totalfacturaNum){
                        console.log("Error, la sumatoria de la factura es mayor al total facturado")
                        return;
                    }

                    if (Math.abs(diferencia) < 0.01) {
                        console.log("El total facturado es correcto");
                        this.continuar = false;
                        document.getElementById('formulariofactura').submit();
                    } else {
                        console.log("El total facturado es incorrecto, la diferencia es: ", diferencia);
                        this.continuar = true;
                    }
                }
            }
        }
    </script>
@endsection
